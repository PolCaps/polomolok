<div class="container-fluid mt-3">
    <div class="row">

       

        <!-- Middle Section for Threads -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card flex-grow-1 shadow-sm">
                <div class="card-header pb-0 d-flex">
                    
                    <div class="d-flex">
                    <a href="#" class="card mb-2 px-2 py-2 shadow-sm mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-wechat text-info" viewBox="0 0 16 16">
                        <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.32.32 0 0 0-.12.366l.218.81a.6.6 0 0 1 .029.117.166.166 0 0 1-.162.162.2.2 0 0 1-.092-.03l-1.057-.61a.5.5 0 0 0-.256-.074.5.5 0 0 0-.142.021 5.7 5.7 0 0 1-1.576.22M9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.6.6 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.63.63 0 0 0 .098.356" />
                        <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.5.5 0 0 0-.032.14.19.19 0 0 0 .193.193q.06 0 .111-.029l1.268-.733a.6.6 0 0 1 .308-.088q.088 0 .171.025a6.8 6.8 0 0 0 1.625.26 4.5 4.5 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02l.15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826m4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0m3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0" />
                    </svg>
                </a>
            </div>
                
            <div class="d-flex">
            <a href="" class="card mb-2 px-2 py-2 d-dlfex shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-lines-fill text-info" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                    </svg>
                </a>
            </div>

            <h6 class="text-info mb-0 mx-5 mt-2">Contacts</h6>
                </div>
                
                <div class="card-body px-0 pb-2" style="max-height: 500px; overflow-y: auto;">
                    <ul class="list-unstyled mx-2 text-sm">
                    <?php
                include('database_config.php');

                // Create a connection
                $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                // Check the connection
                if ($conn->connect_error) {
                    echo '<li class="text-danger">Connection failed: ' . htmlspecialchars($conn->connect_error) . '</li>';
                } else {
                    // Fetch staff users
                    $sqlUsers = "SELECT id, first_name, last_name FROM users"; // Adjust if needed
                    $resultUsers = $conn->query($sqlUsers);

                    // Generate HTML list items for users
                    if ($resultUsers && $resultUsers->num_rows > 0) {
                        while ($row = $resultUsers->fetch_assoc()) {
                            echo '<li class="my-2"><a href="#" class="text-info thread-item" data-value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . ' (Staff)</a></li>';
                        }
                    }

                    // Fetch vendors
                    $sqlVendors = "SELECT vendor_id, first_name, last_name FROM vendors"; // Adjust if needed
                    $resultVendors = $conn->query($sqlVendors);

                    // Generate HTML list items for vendors
                    if ($resultVendors && $resultVendors->num_rows > 0) {
                        while ($row = $resultVendors->fetch_assoc()) {
                            echo '<li class="my-2"><a href="#" class="text-info thread-item" data-value="' . htmlspecialchars($row['vendor_id']) . '">' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . ' (Vendor)</a></li>';
                        }
                    } else {
                        echo '<li class="my-2"><span class="text-secondary">No users or vendors found</span></li>';
                    }
                }

                // Close the connection
                $conn->close();
            ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Sidebar for Chat -->
        <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
            <div class="card flex-grow-1 shadow-sm" style="max-height: 600px;">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="text-info mb-0">Chat</h6>
                        </div>
                        <div class="col-4 my-auto text-end">
                            <button class="btn btn-outline-secondary btn-sm">Action 1</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 d-flex flex-column">
                    <div class="message-container flex-grow-1" style="max-height: 300px; overflow-y: auto;">
                    <div class="message sent text-end">
                <p class="text-sm mb-1">Hello! How are you?</p>
                <div class="d-flex">
                    <p class="text-xs mx-2">Participant</p>
                    <p class="text-xs text-muted">Date Time</p>
                </div>
            </div>
            <div class="message received">
                <p class="text-sm mb-1">Hello! How are you too?</p>
                <div class="d-flex">
                    <p class="text-xs mx-2">Participant</p>
                    <p class="text-xs text-muted">Date Time</p>
                </div>
            </div>
                    </div>
                    <div class="input-group mx-2 my-2 w-100">
                        <div class="input-group-text">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-plus text-info" viewBox="0 0 16 16">
                                    <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z" />
                                    <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5z" />
                                </svg>
                            </a>
                        </div>
                        <input type="text" class="form-control px-2" placeholder="Type your message..." aria-label="Type your message...">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Add custom CSS for message styling -->
<style>
    .card-body {
        display: flex;
        flex-direction: column;
        color: black;
    }
   
    .list-unstyled li {
        list-style: none;
        color: black;
        transition: transform 0.3s ease; /* Smooth transition for the movement */
      
    }

    /* Hover effect for list items */
    .list-unstyled li:hover {
        color: #16c4ec;
        transform: translateX(10px); /* Move the item 10px to the right on hover */
        cursor: pointer; /* Change cursor to pointer on hover */
    }

    .message-container {
        overflow-y: auto;
        padding: 0.5rem;
    }

    .message {
        padding: 8px 12px;
        border-radius: 12px;
        margin: 5px 0;
        max-width: 75%;
        word-wrap: break-word; /* Wrap long text within the message */
    }

    .message.sent {
        background-color: #d1ecf1; /* Light blue for sent messages */
        color: #0c5460;
        align-self: flex-end; /* Align sent messages to the right */
        margin-left: auto; /* Align sent messages to the right */
    }

    .message.received {
        background-color: #e2e3e5; /* Light grey for received messages */
        color: #383d41;
        align-self: flex-start; /* Align received messages to the left */
        margin-right: auto; /* Align received messages to the left */
    }

    .input-group {
        margin-top: 1rem; /* Adjust the top margin for spacing */
    }

    .form-control {
        max-width: 100%; /* Ensures it doesn't exceed the parent container */
    }

    .card-header h6 {
        margin-bottom: 0; /* Remove margin for consistent header spacing */
    }

</style>
