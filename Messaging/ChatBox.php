<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chatbox {
            position: fixed;
            bottom: 20px;
            right: 100px;
            width: 300px;
            border: 1px solid #007bff;
            border-radius: 8px;
            display: none; /* Hidden by default */
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chatbox-header {
            background-color: #17c1e8;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* New CSS for the profile picture */
        .profile-pic {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chatbox-body {
            padding: 10px;
            height: 300px;
            overflow-y: auto;
        }

        .chatbox-footer {
            padding: 10px;
            display: flex;
            align-items: center; /* Center align items vertically */
        }

        .chatbox-footer input[type="text"] {
            flex: 1;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .chatbox-footer input[type="file"] {
            display: none; /* Hide the file input */
        }

        .chatbox-toggle {
            position: fixed;
            bottom: 30px;
            right: 100px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 20px;
            width: 50px;
            height: 50px;
        }

        .message {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <button class="chatbox-toggle" id="chatboxToggle"><i class="bi bi-chat-dots-fill"></i></button>

    <div class="chatbox" id="chatbox">
        <div class="chatbox-header">
            <!-- Profile picture added here -->
             <div>
             <img src="profile-pic.jpg" alt="Profile" class="profile-pic">
             <span>Vendor Name</span>
             </div>
            
            <div>
                <a href="AMmessages.php" class="new-message-link mx-2" id="newMessageLink" 
                   data-bs-toggle="tooltip" data-bs-placement="top"
                   data-bs-custom-class="custom-tooltip"
                   data-bs-title="New Message">
                    <i class="bi bi-pencil-square text-white"></i>
                </a>
                <a href="#" class="close-button" id="closeChatbox" 
                   data-bs-toggle="tooltip" data-bs-placement="top"
                   data-bs-custom-class="custom-tooltip"
                   data-bs-title="Minimize">
                    <i class="bi bi-x-circle text-white"></i>
                </a>
            </div>
        </div>
        <div class="chatbox-body" id="chatboxBody">
            <div class="message">
                <strong>Support:</strong> How can I help you today?
            </div>
        </div>
        <div class="chatbox-footer">
            <input type="text" id="chatInput" placeholder="Type a message...">
            <input type="file" id="fileInput">
            <a href="#" id="attachFile" 
               data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-custom-class="custom-tooltip"
               data-bs-title="Attach File" onclick="document.getElementById('fileInput').click(); return false;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-paperclip text-info mt-2 mx-1" viewBox="0 0 16 16">
                    <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z"/>
                </svg>
            </a>
            <a href="#" id="sendMessage"
               data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-custom-class="custom-tooltip"
               data-bs-title="Send Message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-plus-fill text-info mt-2 mx-1" viewBox="0 0 16 16">
                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                    <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5"/>
                </svg>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('chatboxToggle').addEventListener('click', function() {
            const chatbox = document.getElementById('chatbox');
            chatbox.style.display = chatbox.style.display === 'none' || chatbox.style.display === '' ? 'block' : 'none';
        });

        document.getElementById('closeChatbox').addEventListener('click', function() {
            document.getElementById('chatbox').style.display = 'none';
        });

        document.getElementById('sendMessage').addEventListener('click', function() {
            sendMessage();
        });

        document.getElementById('chatInput').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value;
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            
            if (message || file) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `<strong>You:</strong> ${message ? message : 'Attached a file: ' + file.name}`;
                document.getElementById('chatboxBody').appendChild(messageElement);
                input.value = '';
                fileInput.value = '';
                document.getElementById('chatboxBody').scrollTop = document.getElementById('chatboxBody').scrollHeight;
            }
        }
    </script>
</body>
</html>
