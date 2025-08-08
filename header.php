
<header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #F47F10; padding: 20px;">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="profile.php" class="logo d-flex align-items-center">
            <h1>Oportunidad Real</h1>
        </a>

     
        <!-- End Notification Bell Icon -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li>   <!-- Notification Bell Icon -->
        <div class="notification-bell">
            <i class="fas fa-bell" id="notification-bell"></i>
            <span class="badge" id="notification-count">0</span>
            
            <!-- Notification Dropdown -->
            <div class="notification-dropdown" id="notification-dropdown">
                <!-- Notifications will be dynamically inserted here -->
            </div>
        </div></li>
                <li><a href="profile.php">Home</a></li>
                <li><a href="skprojects.php">All List</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="include/editprofile.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to fetch and display notifications
    function fetchNotifications() {
        $.ajax({
            url: 'fetch_notifications.php', // PHP script to fetch notifications
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var notifications = response.notifications;
                var count = notifications.length;

                // Update notification count
                $('#notification-count').text(count);

                // Clear previous notifications
                $('#notification-dropdown').empty();

                // Populate notifications in dropdown
                if (count > 0) {
                    $.each(notifications, function(index, notification) {
                        var notificationHTML = '<a href="#">' + notification.message + '</a>';
                        $('#notification-dropdown').append(notificationHTML);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    // Initially fetch notifications on page load
    fetchNotifications();

    // Click event for notification bell icon
    $('#notification-bell').on('click', function() {
        // Toggle visibility of notification dropdown
        $('#notification-dropdown').slideToggle('fast');
    });

    // Close dropdown when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.notification-bell').length) {
            $('#notification-dropdown').slideUp('fast');
        }
    });
});
</script>
