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
        $sql = "UPDATE eyewears SET name=?, description=?, price=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssdi", $param_name, $param_description, $param_price, $param_id);

            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_id = $_POST["id"];

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
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM eyewears WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $name = $row["name"];
                    $description = $row["description"];
                    $price = $row["price"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
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
    <title>Update Eyewear</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form_style.css">
</head>
<body class="background-image">
<?php include('header.php'); ?>
<div class="container">
    <h2>Update Eyewear</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
