<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGN Communication Portal</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/agn/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php $current_page = 'message'; include '../app/views/agn/partials/navbar.php'?>
    <div class="main-content">
        <header class="message-header">
            <h2>Message With GN</h2>
            <?php include '../app/views/agn/partials/header_icons.php'?>
        </header>
        <div class="chat">
        <div class="chat-area">
            <div class="chat-header">
                <div class="contact-info">
                    <img src="<?=ROOT?>/assets/images/gramalink_logo.png" id="currentChatImage" alt="Contact">
                    <div>
                        <h3 id="currentChatName">Select a GN to chat</h3>
                        <p id="currentChatStatus">-</p>
                    </div>
                </div>
                <div class="chat-actions">
                    <!-- Add action buttons if needed -->
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
            <!-- <div class="agn-officer">
                <img src="<?=ROOT?>/assets/images/Profile_image_3.png" alt="AGN Officer">
                <div>
                    <h3>Kasun Gunawardhana</h3>
                    <p>AGN Officer - Active</p>
                </div>
            </div> -->
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search GN" id="gnSearchInput">
            </div>
            <div class="user-list">
                <!-- User profiles will be dynamically added here -->
            </div>
        </div>
        <div id="gnSelectionModal" class="gn-selection-modal" style="display:none;">
            <div class="gn-selection-content">
                <h2>Select Grama Niladhari</h2>
                <div id="gnList">
                    <!-- GN list will be dynamically populated here -->
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <script>
        // Function to populate the user list
        function populateUserList(users) {
            const userList = document.querySelector('.user-list');
            userList.innerHTML = '';

            users.forEach(user => {
                const userItem = document.createElement('div');
                userItem.classList.add('user-item');
                userItem.dataset.userId = user.id;
                userItem.onclick = () => openChat(user);

                const userImage = document.createElement('img');
                userImage.src = user.image;
                userImage.alt = user.name;

                const userInfo = document.createElement('div');
                userInfo.classList.add('user-item-info');

                const userName = document.createElement('h4');
                userName.textContent = user.name;

                const userStatus = document.createElement('p');
                userStatus.textContent = user.status;

                userInfo.appendChild(userName);
                userInfo.appendChild(userStatus);

                userItem.appendChild(userImage);
                userItem.appendChild(userInfo);

                userList.appendChild(userItem);
            });
        }

        // Function to open a chat with the selected user
        function openChat(user) {
            // Update the chat area with the selected user's information
            document.getElementById('currentChatImage').src = user.image;
            document.getElementById('currentChatName').textContent = user.name;
            document.getElementById('currentChatStatus').textContent = user.status;

            // Populate the chat messages with the selected user's chat history
            populateChatMessages(user.chatHistory);
        }

        // Sample user data
        const users = [
            {
                id: 1,
                name: 'Amantha Tharusha',
                image: '<?=ROOT?>/assets/images/Profile_image_2.png',
                status: 'Online',
                chatHistory: [
                    { sender: 'John Doe', message: 'Hello!' },
                    { sender: 'You', message: 'Hi there!' },
                    { sender: 'John Doe', message: 'How are you?' },
                    { sender: 'You', message: 'I\'m doing great, thanks!' }
                ]
            },
            {
                id: 2,
                name: 'Dilshanee Nadeesha',
                image: '<?=ROOT?>/assets/images/Profile_image_6.png',
                status: 'Offline',
                chatHistory: [
                    { sender: 'Jane Smith', message: 'Hey, how\'s it going?' },
                    { sender: 'You', message: 'Pretty good, just working on some things.' },
                    { sender: 'Jane Smith', message: 'Sounds good. Let me know if you need any help!' }
                ]
            },
            {
        id: 3,
        name: 'Kavishka Jayathilake',
        image: '<?=ROOT?>/assets/images/Profile_image_5.png',
        status: 'Online',
        chatHistory: [
            { sender: 'Michael Johnson', message: 'Good morning!' },
            { sender: 'You', message: 'Hello, how can I assist you today?' },
            { sender: 'Michael Johnson', message: 'I have a question about the GN application.' }
        ]
    },
    {
        id: 4,
        name: 'Sujan Darshana',
        image: '<?=ROOT?>/assets/images/Profile_image_4.png',
        status: 'Offline',
        chatHistory: [
            { sender: 'Emily Davis', message: 'Hi, I need some help with the GN portal.' },
            { sender: 'You', message: 'Sure, how can I help you?' },
            { sender: 'Emily Davis', message: 'I\'m having trouble logging in.' }
        ]
    }
            // Add more users as needed
        ];

        // Initial population of the user list
        populateUserList(users);
    </script>
</body>
</html>