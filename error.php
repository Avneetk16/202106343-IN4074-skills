<?php
  session_start();

  if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    $error_array = $_SESSION['errors'];
  } else {
    $error_array = [];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <ul>
    <h3>There are some errors in your form</h3>
    <?php foreach($error_array as $error) { ?>
      <li><?php echo $error ?></li>
    <?php } ?>
  </ul>
  <a type="button" href="index.php">Back</a>
</body>
</html>