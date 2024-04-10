<?php
include('config.php');

$id = $_GET['id'];

$sql = "SELECT * FROM eyewears WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eyewear Details</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .player {
            width: 400px;
            margin: 0% 35%;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="containers">
        <h2>Eyewear Details</h2>
        <div class="player">
            <img src="images/glasses3.avif" alt="" width="400">
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
            <p><strong>Price:</strong> <?php echo $row['price']; ?></p>
        </div><br>
        <div class="content-center">
            <a href="ew_index.php" class="btn">Back to Eyewears</a>
            <a href="ew_update.php?id=<?php echo $row['id']; ?>" class="btn">Update Eyewear</a>
            <a href="ew_delete.php?id=<?php echo $row['id']; ?>" class="btn">Delete Eyewear</a>
        </div>
    </div>
</body>
</html>
