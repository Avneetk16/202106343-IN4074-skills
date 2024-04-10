<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM eyewears WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            header("location: ew_index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Eyewear</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form_style.css">
</head>
<body>
<?php include('header.php'); ?>
  <div class="container">
      <h2>Delete Eyewear</h2>
      <p>Are you sure you want to delete this eyewear?</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="form-group content-center">
              <a href="ew_index.php" class="btn ml-2">Cancel</a>
              <button type="submit" class="btn btn-danger" value="Submit">Delete</button>
          </div>
      </form>
  </div>
</body>
</html>
