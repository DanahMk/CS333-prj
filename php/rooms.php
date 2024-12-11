<?php
session_start();
include 'php/connect.php'; 
include 'admin/header.php'; 

// Fetch all rooms from the database
$sql_rooms = "SELECT * FROM rooms";
$result_rooms = $conn->query($sql_rooms);
if ($result_rooms === false) {
    echo "<p>Error retrieving rooms: " . $conn->error . "</p>";
    $result_rooms = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms Presentation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        :root {
            --colorfirst: #8739F9;
            --colorSecond: #37B9F1;
            --colorback: #F2F5F5;
            --colorShadow: #565360;
            --colorLabel: #908E9B;
        }

        body {
            background-color: var(--colorback);
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .rooms-section {
            padding: 40px 20px;
            background: var(--colorback);
        }

        .rooms-section h1 {
            text-align: center;
            color: var(--colorShadow);
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .room-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .room-content {
            padding: 20px;
        }

        .room-content h2 {
            color: var(--colorShadow);
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .room-content p {
            color: var(--colorLabel);
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .room-content .details {
            font-size: 0.9rem;
            color: var(--colorSecond);
            font-weight: bold;
        }

        .room-content .book-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: var(--colorfirst);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .room-content .book-btn:hover {
            background: var(--colorSecond);
        }
    </style>
</head>
<body>
<section class="rooms-section">
    <h1>Our <span>Rooms</span></h1>
    <div class="rooms-grid">
        <?php if ($result_rooms && $result_rooms->num_rows > 0): ?>
            <?php while ($room = $result_rooms->fetch_assoc()): ?>
                <div class="room-card">
                    <img src="uploads/<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['room_name']); ?>">
                    <div class="room-content">
                        <h2><?php echo htmlspecialchars($room['room_name']); ?></h2>
                        <p><?php echo htmlspecialchars($room['description']); ?></p>
                        <div class="details">
                            Capacity: <?php echo htmlspecialchars($room['capacity']); ?> People <br>
                            Features: <?php echo htmlspecialchars($room['features']); ?>
                        </div>
                        <a href="book-room.php?id=<?php echo htmlspecialchars($room['id']); ?>" class="book-btn">Book Now</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No rooms available...</p>
        <?php endif; ?>
    </div>
</section>
</body>
</html>
<?php $conn->close(); ?>
