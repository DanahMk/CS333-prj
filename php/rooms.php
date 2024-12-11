<?php
session_start();
require_once('../common-db-settings.php');

// Verify database connection
if (!$conn) {
    die("Database connection failed. Please check your configuration.");
}

try {
    // Fetch all rooms with error handling
    $sql_rooms = "SELECT * FROM rooms ORDER BY room_name";
    $result_rooms = $conn->query($sql_rooms);

    if ($result_rooms === false) {
        throw new Exception("Error retrieving rooms: " . $conn->error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $error_message = "An error occurred while retrieving room information.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Browsing - IT Room Booking System</title>
    <style>
        /* Custom CSS with responsive design */
        :root {
            --primary-color: #243642;
            --secondary-color: #387478;
            --background-color: #E2F1E7;
            --text-color: #333;
            --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .room-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .room-info {
            margin-bottom: 15px;
        }

        .room-name {
            font-size: 1.5em;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .room-details {
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .room-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .room-name {
                font-size: 1.3em;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .room-grid {
                grid-template-columns: 1fr;
            }

            .room-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Available Rooms</h1>

        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <div class="room-grid">
            <?php 
            if (isset($result_rooms) && $result_rooms->num_rows > 0):
                while ($room = $result_rooms->fetch_assoc()):
            ?>
                <div class="room-card">
                    <?php if (!empty($room['image'])): ?>
                        <img 
                            src="../images/<?php echo htmlspecialchars($room['image']); ?>" 
                            alt="<?php echo htmlspecialchars($room['room_name']); ?>"
                            class="room-image"
                        >
                    <?php endif; ?>

                    <div class="room-info">
                        <h2 class="room-name"><?php echo htmlspecialchars($room['room_name']); ?></h2>
                        <p class="room-details">
                            <strong>Capacity:</strong> 
                            <?php echo htmlspecialchars($room['capacity']); ?> people
                        </p>
                        <p class="room-details">
                            <strong>Equipment:</strong> 
                            <?php echo htmlspecialchars($room['equipment']); ?>
                        </p>
                    </div>

                    <a href="room_details.php?room_id=<?php echo $room['id']; ?>" class="btn">
                        View Details
                    </a>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <p>No rooms are currently available.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Add any necessary JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Add loading state for images
            const images = document.querySelectorAll('.room-image');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
            });
        });
    </script>
</body>
</html>

<?php
// Clean up
if (isset($result_rooms)) {
    $result_rooms->close();
}
if (isset($conn)) {
    $conn->close();
}
?>
