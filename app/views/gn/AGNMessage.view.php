<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GN Communication Portal</title>
     
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/gn/message.css">
</head>
<body>
    <?php $current_page = 'agnmessage'; include '../app/views/gn/partials/navbar.php';?>

    <div class="main-content">
        <div class="chat-area">
            <div class="chat-header">
                <div class="contact-info">
                    <img src="<?=ROOT?>/assets/images/Profile_image_3.png" alt="AGN Officer">
                    <div>
                        <h3>Kasun Gunawardhana</h3>
                        <p>AGN Officer - Active</p>
                    </div>
                </div>
                <div class="chat-actions">
                    <!-- <button class="action-btn"><i class="fas fa-phone"></i></button> -->
                    <!-- <button class="action-btn"><i class="fas fa-video"></i></button> -->
                    <button class="action-btn"><i class="fas fa-info-circle"></i></button>
                </div>
            </div>
            <div id="chatMessages" class="chat-messages">
                <!-- Messages will be dynamically populated here -->
            </div>
            <div class="chat-input">
                <button class="attachment-btn"><i class="fas fa-paperclip"></i></button>
                <button class="emoji-btn"><i class="far fa-smile"></i></button>
                <div class="input-wrapper">
                    <input type="text" placeholder="Type a message..." id="messageInput">
                </div>
                <button class="send-btn" onclick="sendMessage()">Send</button>
            </div>
        </div>
        <div class="chatsidebar">
            <div class="agn-officer">
                <img src="<?=ROOT?>/assets/images/Profile_image_3.png" alt="GN Officer">
                <div>
                    <h3>Kasun Gunawardhana</h3>
                    <p>AGN Officer - Active</p>
                </div>
            </div>
            <div class="chat-info">
                <div class="status-indicator">
                    <span class="status-dot online"></span>
                    <p>Your AGN Officer is currently online</p>
                </div>
                <div class="contact-details">
                    <p><i class="fas fa-envelope"></i> kasun.g@agn.gov.lk</p>
                    <p><i class="fas fa-phone"></i> +94 77 123 4567</p>
                </div>
            </div>
        </div>
    </div>


    
    <script>
        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            
            if (message) {
                const chatMessages = document.getElementById('chatMessages');
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message', 'sent');
                
                const content = document.createElement('div');
                content.classList.add('message-content');
                content.textContent = message;
                
                const time = document.createElement('div');
                time.classList.add('message-time');
                time.textContent = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                messageDiv.appendChild(content);
                messageDiv.appendChild(time);
                chatMessages.appendChild(messageDiv);
                
                input.value = '';
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>