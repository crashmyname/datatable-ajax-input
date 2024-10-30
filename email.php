<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email-Style Chat Template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }

        .sidebar h2 i {
            margin-right: 10px;
            font-size: 1.5em;
            color: #00bcd4;
            /* Color untuk ikon */
        }

        .sidebar button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .sidebar button i {
            margin-right: 8px;
        }

        .sidebar button:hover {
            background-color: #0056b3;
        }

        .sidebar a {
            color: #ffffff;
            font-size: 18px;
            padding: 10px 0;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background 0.3s;
            border-radius: 4px;
            padding: 10px;
        }

        .sidebar a i {
            margin-right: 12px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .search-bar {
            background-color: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            width: 75%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-bar select {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #ffffff;
            color: #333;
        }

        .content {
            display: flex;
            flex: 1;
        }

        .chat-list {
            width: 30%;
            background-color: #ffffff;
            overflow-y: auto;
            /* Membuat chat list dapat di-scroll */
            border-right: 1px solid #ddd;
            padding: 10px;
            max-height: 100vh;
            /* Mengatur batas tinggi maksimal */
        }

        .chat-list-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 6px;
        }

        .chat-list-item:hover {
            background-color: #f1f1f1;
        }

        .chat-list-item h4 {
            font-size: 16px;
            color: #333;
        }

        .chat-list-item p {
            font-size: 14px;
            color: #888;
        }

        .chat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        .chat-header {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-header h3 {
            font-size: 18px;
            color: #333;
        }

        .messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f9f9f9;
            max-height: calc(100vh - 200px);
            /* Menyesuaikan dengan layout secara keseluruhan */
        }


        .message {
            margin-bottom: 20px;
            max-width: 70%;
        }

        .message .sender {
            font-weight: bold;
            color: #007bff;
        }

        .message .text {
            padding: 12px;
            border-radius: 10px;
            background-color: #f1f1f1;
            color: #333;
            position: relative;
            margin-top: 5px;
        }

        .message .timestamp {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        .message.sent .text {
            background-color: #007bff;
            color: #ffffff;
        }

        .reply-box {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: #ffffff;
            align-items: center;
        }

        .reply-box input {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }

        .reply-box button {
            padding: 9px 20px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .reply-box button:hover {
            background-color: #0056b3;
        }

        .emoji-picker {
            display: none;
            position: absolute;
            bottom: 70px;
            left: 1500px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .emoji {
            cursor: pointer;
            font-size: 20px;
            margin: 5px;
        }

        input[type="file"] {
            display: none;
            /* Sembunyikan input file asli */
        }

        .custom-file-upload {
            display: inline-flex;
            align-items: center;
            background-color: #007bff;
            /* Warna latar belakang */
            color: white;
            /* Warna teks */
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #0056b3;
            /* Warna latar belakang saat hover */
        }

        .custom-file-upload i {
            margin-right: 5px;
            /* Jarak antara ikon dan teks */
        }

        .modal {
            display: none;
            /* Awalnya modal disembunyikan */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna semi transparan */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-body input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .close-btn,
        .submit-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn {
            background-color: #ccc;
            color: #333;
        }

        .submit-btn {
            background-color: #007bff;
            color: #fff;
        }

        .close-btn:hover,
        .submit-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2><i class="fas fa-comments"></i> Email Chat</h2>
        <button id="newChatButton"><i class="fas fa-plus"></i> New Chat</button>
        <a href="#"><i class="fas fa-inbox"></i> Inbox</a>
        <a href="#"><i class="fas fa-pencil-alt"></i> Drafts</a>
        <a href="#"><i class="fas fa-paper-plane"></i> Sent</a>
        <a href="#"><i class="fas fa-star"></i> Starred</a>
        <a href="#"><i class="fas fa-ban"></i> Spam</a>
        <a href="#"><i class="fas fa-trash"></i> Trash</a>
    </div>

    <div class="main-content">
        <div class="search-bar">
            <input type="text" placeholder="Search messages...">
            <select>
                <option value="all">All</option>
                <option value="unread">Unread</option>
                <option value="read">Read</option>
                <option value="starred">Starred</option>
            </select>
        </div>

        <div class="content">
            <!-- Chat List Section -->
            <div class="chat-list">
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
                <div class="chat-list-item">
                    <h4>Support Team</h4>
                    <p>Hello, how can we help you today?</p>
                </div>
                <div class="chat-list-item">
                    <h4>John Doe</h4>
                    <p>Do you have any updates on my order?</p>
                </div>
            </div>

            <!-- Chat Content Section -->
            <div class="chat-content">
                <div class="chat-header">
                    <h3>Support Team</h3>
                    <span>10:30 AM</span>
                </div>
                <div class="messages">
                    <div class="message received">
                        <span class="sender">Support Team</span>
                        <div class="text">Hello! How can I assist you today?</div>
                        <div class="timestamp">10:30 AM</div>
                    </div>
                    <div class="message sent">
                        <span class="sender">You</span>
                        <div class="text">I have a question about my order.</div>
                        <div class="timestamp">10:31 AM</div>
                    </div>
                    <div class="message received">
                        <span class="sender">Support Team</span>
                        <div class="text">Can you please provide me with your order number?</div>
                        <div class="timestamp">10:32 AM</div>
                    </div>
                    <div class="message sent">
                        <span class="sender">You</span>
                        <div class="text">Sure, it's #123456.</div>
                        <div class="timestamp">10:33 AM</div>
                    </div>
                    <div class="message received">
                        <span class="sender">Support Team</span>
                        <div class="text">Can you please provide me with your order number?</div>
                        <div class="timestamp">10:32 AM</div>
                    </div>
                    <div class="message sent">
                        <span class="sender">You</span>
                        <div class="text">Sure, it's #123456.</div>
                        <div class="timestamp">10:33 AM</div>
                    </div>
                    <div class="message received">
                        <span class="sender">Support Team</span>
                        <div class="text">Can you please provide me with your order number?</div>
                        <div class="timestamp">10:32 AM</div>
                    </div>
                    <div class="message sent">
                        <span class="sender">You</span>
                        <div class="text">Sure, it's #123456.</div>
                        <div class="timestamp">10:33 AM</div>
                    </div>
                    <div class="message received">
                        <span class="sender">Support Team</span>
                        <div class="text">Can you please provide me with your order number?</div>
                        <div class="timestamp">10:32 AM</div>
                    </div>
                    <div class="message sent">
                        <span class="sender">You</span>
                        <div class="text">Sure, it's #123456.</div>
                        <div class="timestamp">10:33 AM</div>
                    </div>
                </div>
                <div class="reply-box">
                    <input type="text" placeholder="Type your message..." />
                    <label for="attachment" class="custom-file-upload">
                        <i class="fa fa-upload"></i> <!-- Anda bisa mengganti dengan ikon lain jika diperlukan -->
                        Choose file
                    </label>
                    <input type="file" id="attachment" class="attachment" />
                    &nbsp;
                    <button><i class="fas fa-paper-plane"></i> Send</button>
                    &nbsp;
                    <button class="emoji-btn"><i class="fas fa-smile"></i></button>
                </div>
                <div class="emoji-picker">
                    <span class="emoji">😀</span>
                    <span class="emoji">😁</span>
                    <span class="emoji">😂</span>
                    <span class="emoji">🤣</span>
                    <span class="emoji">😃</span>
                    <span class="emoji">😄</span>
                    <span class="emoji">😅</span>
                    <span class="emoji">😆</span>
                    <span class="emoji">😉</span>
                    <span class="emoji">😊</span>
                    <span class="emoji">😋</span>
                    <span class="emoji">😎</span>
                    <span class="emoji">😍</span>
                    <span class="emoji">😘</span>
                    <span class="emoji">🥰</span>
                    <span class="emoji">😗</span>
                    <span class="emoji">😙</span>
                    <span class="emoji">😚</span>
                    <span class="emoji">😜</span>
                    <span class="emoji">🤗</span>
                    <span class="emoji">🤩</span>
                    <span class="emoji">🤔</span>
                </div>
            </div>
            <div id="newChatModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">New Chat</div>
                    <div class="modal-body">
                        <input type="text" placeholder="Enter recipient...">
                    </div>
                    <div class="modal-footer">
                        <button class="close-btn">Close</button>
                        <button class="submit-btn">Start Chat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const emojiBtn = document.querySelector('.emoji-btn');
        const emojiPicker = document.querySelector('.emoji-picker');
        const messageInput = document.querySelector('.reply-box input');

        emojiBtn.addEventListener('click', () => {
            emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
        });

        // Menambahkan emoji ke input
        document.querySelectorAll('.emoji').forEach(emoji => {
            emoji.addEventListener('click', () => {
                messageInput.value += emoji.textContent;
                emojiPicker.style.display = 'none';
            });
        });

        // Menyembunyikan emoji picker saat mengklik di luar
        document.addEventListener('click', (event) => {
            if (!emojiPicker.contains(event.target) && !emojiBtn.contains(event.target)) {
                emojiPicker.style.display = 'none';
            }
        });
        const newChatButton = document.getElementById("newChatButton");
    const newChatModal = document.getElementById("newChatModal");
    const closeBtn = newChatModal.querySelector(".close-btn");

    // Menampilkan modal ketika tombol New Chat diklik
    newChatButton.addEventListener("click", () => {
        newChatModal.style.display = "flex";
    });

    // Menutup modal ketika tombol Close diklik
    closeBtn.addEventListener("click", () => {
        newChatModal.style.display = "none";
    });

    // Menutup modal jika area di luar modal diklik
    window.addEventListener("click", (event) => {
        if (event.target === newChatModal) {
            newChatModal.style.display = "none";
        }
    });

        function openModal() {
            document.getElementById("newChatModal").style.display = "flex";
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById("newChatModal").style.display = "none";
        }

        // Fungsi untuk memulai chat (bisa disesuaikan dengan kebutuhan aplikasi)
        function startChat() {
            const recipientName = document.getElementById("recipientName").value;
            const initialMessage = document.getElementById("initialMessage").value;

            if (recipientName && initialMessage) {
                // Lakukan proses memulai chat, misalnya simpan data atau tampilkan di daftar chat
                console.log("Starting chat with", recipientName, ":", initialMessage);

                // Tutup modal setelah proses selesai
                closeModal();
            } else {
                alert("Please fill in all fields.");
            }
        }
    </script>

</body>

</html>
