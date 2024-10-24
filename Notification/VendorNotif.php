<?php
// Database connection
include('database_config.php'); // Adjust path if necessary

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the latest 5 unread notifications for Admin
$sql = "SELECT * FROM notifications WHERE vendor_id = $vendor_id AND is_read = 0 ORDER BY time_stamp DESC LIMIT 5";
$result = $conn->query($sql);

// Get the number of unread notifications
$unreadCount = $result->num_rows;

// Close the database connection
$conn->close();
?>
<style>
    .position-relative {
    position: relative; /* Set the position of the parent element */
}

#notification-count {
    position: absolute; /* Position the badge */
    top: 0;             /* Adjust this value if needed */
    right: 0;          /* Keep the badge in the top-right corner */
    transform: translate(50%, -50%); /* Center the badge relative to the corner */
}

@media (max-width: 576px) {
    #notification-count {
        /* Adjust badge position for smaller screens if necessary */
        top: 0; 
        right: 0; 
    }
}
</style>

<li class="nav-item dropdown pe-2 d-flex align-items-center mx-2 position-relative">
    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell cursor-pointer me-sm-1"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-count">
            <?php echo $unreadCount > 0 ? $unreadCount : '0'; ?>
            <span class="visually-hidden">unread messages</span>
        </span>
        <span class="d-sm-inline d-none">Notification</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" style="max-height: 280px; overflow-y: auto;">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" data-notif-id="<?= $row['notif_id'] ?>">
                        <div class="d-flex py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold"><?= $row['notification_type'] ?><br></span>
                                    <?= $row['message'] ?>
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    <i class="fa fa-clock me-1"></i>
                                    <?= date('F j, Y, g:i a', strtotime($row['time_stamp'])) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li class="mb-2 text-center">No new notifications</li>
        <?php endif; ?>
    </ul>
</li>
<script>
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function() {
            const notifId = this.getAttribute('data-notif-id'); // Get the notif_id
            const notificationType = this.querySelector('h6 span').innerText.trim(); // Trim whitespace
            console.log('Notification Type:', notificationType); // Debug log

            // Mark the notification as read
            fetch('Notification/mark_readNotif.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ 
                    mark_read: true,
                    notif_id: notifId // Include notif_id in the request
                })
            })
            .then(response => {
                if (response.ok) {
                    // Redirect based on notification type
                    switch (notificationType) {
                        case 'Relocation Request Status':
                            window.location.href = 'VMRelocation.php';
                            break;
                        
                        default:
                            console.log('No action defined for this notification type:', notificationType); // More details
                    }
                } else {
                    console.error('Failed to mark notification as read:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>