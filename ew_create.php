<?php
include('config.php');

$name = $description = $price = '';
$name_err = $description_err = $price_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter the eyewear name.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter the eyewear description.";
    } else {
        $description = trim($_POST["description"]);
    }

    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter the eyewear price.";
    } else {
        $price = trim($_POST["price"]);
    }

    if (empty($name_err) && empty($description_err) && empty($price_err)) {
        $sql = "INSERT INTO eyewears (name, description, price) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssd", $param_name, $param_description, $param_price);

            $param_name = $name;
            $param_description = $description;
            $param_price = $price;

            if (mysqli_stmt_execute($stmt)) {
                header("location: ew_index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Eyewear</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form_style.css">
</head>
<body class="background-image">
<?php include('header.php'); ?>
<div class="container">
    <h2>Add New Eyewear</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
            <span class="invalid-feedback"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
            <span class="invalid-feedback"><?php echo $description_err; ?></span>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
            <span class="invalid-feedback"><?php echo $price_err; ?></span>
        </div>
        <div class="form-group content-center">
          <a href="ew_index.php" class="btn ml-2">Cancel</a>
          <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
