<form id="batchSaveForm">
    <table id="dynamicTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Baris pertama -->
            <tr>
                <td><input type="text" name="data[0][nama]" required></td>
                <td><input type="email" name="data[0][email]" required></td>
                <td><input type="text" name="data[0][posisi]" required></td>
                <td><input type="text" name="data[0][departemen]" required></td>
                <td><button type="button" onclick="removeRow(this)">Hapus</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" onclick="addRow()">Add Row</button>
    <button type="submit">Save</button>
</form>
<script>
    let rowIndex = 1;

function addRow() {
    const table = document.getElementById("dynamicTable").getElementsByTagName("tbody")[0];
    const newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="data[${rowIndex}][nama]" required></td>
        <td><input type="email" name="data[${rowIndex}][email]" required></td>
        <td><input type="text" name="data[${rowIndex}][posisi]" required></td>
        <td><input type="text" name="data[${rowIndex}][departemen]" required></td>
        <td><button type="button" onclick="removeRow(this)">Hapus</button></td>
    `;
    rowIndex++;
}

function removeRow(button) {
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
document.getElementById("batchSaveForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    fetch("save.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Data berhasil disimpan!");
        } else {
            alert("Gagal menyimpan data.");
        }
    })
    .catch(error => console.error("Error:", error));
});

</script>