<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    $sql = "DELETE FROM resources WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Resource deleted successfully";
    } else {
        echo "Error deleting resource: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: demo.php");
    exit();
} else {
    echo "Invalid request";
}
?>
