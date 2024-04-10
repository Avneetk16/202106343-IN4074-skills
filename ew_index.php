<?php
include('config.php');

$sql = "SELECT * FROM eyewears";
$result = mysqli_query($conn, $sql);

$eyewears = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $eyewears[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eyewears</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="background-image">
    <?php include('header.php'); ?>
    <h1 class="title content-center">Eyewears Shop</h1>
    <div class="content-right">
        <a href="ew_create.php" class="btn" type="button">Add Glasses</a>
    </div>
    <div class="container2">
        <?php if (!empty($eyewears)) { ?>
            <?php foreach ($eyewears as $player) { ?>
                <div class="player" onclick="window.location.href='ew_read.php?id=<?php echo $player['id'] ?>'">
                <img src="images/glasses2.avif" alt="" width="300">
                <p><strong>Name:</strong><?php echo $player['name'] ?></p>
                <p><strong>Description:</strong><?php echo $player['description'] ?></p>
                <p><strong>Price: $</strong><?php echo $player['price'] ?></p>
                </div>
        <?php } } else { ?>
            <p>No Eyewears found.</p>
        <?php } ?>
    </div>
</body>
</html>
