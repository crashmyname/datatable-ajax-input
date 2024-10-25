<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DataTables Server-side Processing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .edited {
            background-color: #fff3cd !important;
            /* Kuning */
        }
    </style>
</head>

<body>

    <div class="container my-4">
        <h2 class="text-center mb-4">Edit Employee Data</h2>
        <form id="batchEditForm">
            <div class="table-responsive">
                <table id="dynamicEditTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Posisi</th>
                            <th>Departemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan dimuat menggunakan AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            const table = $('#dynamicEditTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: 'get_data.php', // Ubah ini dengan URL endpoint untuk mengambil data
                    type: 'POST'
                },
                columns: [{
                        data: 'nama',
                        render: function(data, type, row) {
                            return `<input type="text" class="form-control" name="data[${row.id}][nama]" value="${data}" required onchange="markEdited(this)">`;
                        }
                    },
                    {
                        data: 'email',
                        render: function(data, type, row) {
                            return `<input type="email" class="form-control" name="data[${row.id}][email]" value="${data}" required onchange="markEdited(this)">`;
                        }
                    },
                    {
                        data: 'posisi',
                        render: function(data, type, row) {
                            return `<input type="text" class="form-control" name="data[${row.id}][posisi]" value="${data}" required onchange="markEdited(this)">`;
                        }
                    },
                    {
                        data: 'departemen',
                        render: function(data, type, row) {
                            return `<input type="text" class="form-control" name="data[${row.id}][departemen]" value="${data}" required onchange="markEdited(this)">`;
                        }
                    }
                ]
            });

            // Handle perubahan data
            window.markEdited = function(input) {
                $(input).addClass('edited'); // Tandai kolom yang diedit sebagai kuning

                // Simpan data ke localStorage jika diperlukan
                const id = $(input).attr('name').match(/\d+/)[0]; // Ambil ID dari nama input
                const field = $(input).attr('name').match(/\[(.*?)\]/)[1]; // Ambil nama field
                const value = $(input).val();

                const editedData = JSON.parse(localStorage.getItem('editedData')) || {};
                if (!editedData[id]) {
                    editedData[id] = {};
                }
                editedData[id][field] = value; // Simpan nilai yang diedit
                localStorage.setItem('editedData', JSON.stringify(editedData)); // Simpan ke localStorage
            };

            // Handle form submission
            $("#batchEditForm").on("submit", function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const editedItems = JSON.parse(localStorage.getItem('editedData')) || {};

                // Tambahkan data yang diedit ke formData
                formData.append('editedItems', JSON.stringify(editedItems));

                fetch("edit.php", {
                        method: "POST",
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data berhasil disimpan',
                            });
                            localStorage.removeItem('editedData'); // Reset localStorage setelah save
                            table.ajax.reload(null, false); // Reload data setelah edit
                        } else {
                            alert("Gagal memperbarui data.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            // Restore edited fields on page load
            const savedEdits = JSON.parse(localStorage.getItem('editedData')) || {};
            for (const id in savedEdits) {
                const editedFields = savedEdits[id];
                for (const field in editedFields) {
                    const input = $(`input[name="data[${id}][${field}]"]`);
                    if (input.length) {
                        input.val(editedFields[field]);
                        input.addClass('edited'); // Tandai input sebagai diedit
                    }
                }
            }
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>
