<style>
    body{
    background-color: #f4f7f6;
    margin-top:20px;
}
.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 300px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}
.people-list .chat-list {
    max-height: 500px; /* Set the maximum height as needed */
    overflow-y: auto; /* Enable vertical scrolling */
}
.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}
.search-bar-mobile {
    display: none;
}
@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
    .search-bar-mobile {
        display: block;
    }
    /* Hide the search bar in the people list for small screens */
    .people-list .input-group {
        display: none;
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}
</style>


<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        <?php
                        include('database_config.php');

                        // Create a connection
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                        // Check the connection
                        if ($conn->connect_error) {
                            echo '<li class="text-danger">Connection failed: ' . htmlspecialchars($conn->connect_error) . '</li>';
                        } else {
                            // Fetch staff users
                            $sqlUsers = "SELECT id, first_name, last_name, picture_profile FROM users"; // Adjust if needed
                            $resultUsers = $conn->query($sqlUsers);

                            // Generate HTML list items for users
                            if ($resultUsers && $resultUsers->num_rows > 0) {
                                while ($row = $resultUsers->fetch_assoc()) {
                                    echo '<li class="clearfix">';
                                    
                                    // Construct the image path and display it
                                    $imagePath = htmlspecialchars($row['picture_profile']);
                                    echo '<img src="' . $imagePath . '" alt="avatar" onerror="this.src=\'https://bootdey.com/img/Content/avatar/avatar1.png\';">'; // Fallback image if profile picture is not found
                                    
                                    echo '<div class="about">';
                                    echo '<div class="name text-sm">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</div>';
                                    echo '<span class="text-xs">Staff</span>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            }

                            // Fetch vendors
                            $sqlVendors = "SELECT vendor_id, first_name, last_name FROM vendors"; // Adjust if needed
                            $resultVendors = $conn->query($sqlVendors);

                            // Generate HTML list items for vendors
                            if ($resultVendors && $resultVendors->num_rows > 0) {
                                while ($row = $resultVendors->fetch_assoc()) {
                                    echo '<li class="clearfix">';
                                    echo '<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">'; // Placeholder image
                                    echo '<div class="about">';
                                    echo '<div class="name ">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</div>';
                                    echo '<span class="text-xs">Vendor</span>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            } else {
                                echo '<li>No users or vendors found</li>';
                            }
                        }

                        // Close the connection
                        $conn->close();
                        ?>
                    </ul>
                </div>
                <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6 col-8">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0">Briar Rose</h6>
                                <small>Vendor</small>
                            </div>
                        </div>
                        <div class="col-lg-1 col-1 text-end search-bar-mobile">
                            <div class="input-group">
                                <div class="d-flex mx-7">
                                <a href="#" class="mt-3 mx-2" id="showThreads" data-bs-toggle="modal" data-bs-target="#threadsModal">
                                    <i class="fa fa-search text-info"></i>
                                </a>   
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="chat-history">
                        <ul class="m-b-0">
                            <li class="clearfix">
                                <div class="message-data text-end">
                                    <span>Senders Name</span>
                                </div>
                                <div class="message other-message float-end">Hi Aiden, how are you? How is the project coming along? 
                                <br>
                                <span class="message-data-time text-xs">10:10 AM, Today</span>
                            </div>
                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                <span>Briar Rose</span>
                                    
                                </div>
                                <div class="message my-message">Are we meeting today?
                                <br>
                                <span class="message-data-time text-xs">10:13 AM, Today</span>
                                </div>
                                
                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <span class="message-data-time">10:15 AM, Today</span>
                                </div>
                                <div class="message my-message">Project has been already finished and I have results to show you.</div>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <span class="input-group-text"><a href="" type="submit"><i class="fa fa-send text-info px-2"></i></a></span>
                            <input type="text" class="form-control" placeholder="Enter text here...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="threadsModal" tabindex="-1" aria-labelledby="threadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="threadsModalLabel">Threads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        <?php
                        include('database_config.php');

                        // Create a connection
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                        // Check the connection
                        if ($conn->connect_error) {
                            echo '<li class="text-danger">Connection failed: ' . htmlspecialchars($conn->connect_error) . '</li>';
                        } else {
                            // Fetch staff users
                            $sqlUsers = "SELECT id, first_name, last_name, picture_profile FROM users"; // Adjust if needed
                            $resultUsers = $conn->query($sqlUsers);

                            // Generate HTML list items for users
                            if ($resultUsers && $resultUsers->num_rows > 0) {
                                while ($row = $resultUsers->fetch_assoc()) {
                                    echo '<li class="clearfix">';
                                    
                                    // Construct the image path and display it
                                    $imagePath = htmlspecialchars($row['picture_profile']);
                                    echo '<img src="' . $imagePath . '" alt="avatar" onerror="this.src=\'https://bootdey.com/img/Content/avatar/avatar1.png\';">'; // Fallback image if profile picture is not found
                                    
                                    echo '<div class="about">';
                                    echo '<div class="name">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</div>';
                                    echo '<span class="text-sm">Staff</span>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            }

                            // Fetch vendors
                            $sqlVendors = "SELECT vendor_id, first_name, last_name FROM vendors"; // Adjust if needed
                            $resultVendors = $conn->query($sqlVendors);

                            // Generate HTML list items for vendors
                            if ($resultVendors && $resultVendors->num_rows > 0) {
                                while ($row = $resultVendors->fetch_assoc()) {
                                    echo '<li class="clearfix">';
                                    echo '<img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">'; // Placeholder image
                                    echo '<div class="about">';
                                    echo '<div class="name">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</div>';
                                    echo '<span class="text-sm">Vendor</span>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            } else {
                                echo '<li>No users or vendors found</li>';
                            }
                        }

                        // Close the connection
                        $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script>
    // Sample function to send a message
    function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value;
        if (message.trim() === '') return; // Avoid sending empty messages

        // Send message to server via AJAX
        fetch('send_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Display the sent message in the chat
                displayMessage(message, 'my-message');
                messageInput.value = ''; // Clear input after sending
            }
        });
    }

    // Sample function to fetch new messages
    function fetchMessages() {
        fetch('Messages/get_messages.php')
        .then(response => response.json())
        .then(messages => {
            messages.forEach(msg => {
                displayMessage(msg.content, msg.type);
            });
        });
    }

    // Helper function to display a message in the chat
    function displayMessage(message, messageType) {
        const messageList = document.querySelector('.chat-history ul');
        const messageElement = document.createElement('li');
        messageElement.classList.add(messageType);
        messageElement.innerHTML = `<div class="message">${message}</div>`;
        messageList.appendChild(messageElement);
    }

    // Automatically fetch new messages every few seconds
    setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds
</script>
