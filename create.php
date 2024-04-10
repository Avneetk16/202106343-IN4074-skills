<?php
include 'config.php';
$author_last_name = '';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
        $errors["title"] = "Title is required";
    } else {
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
    }

    if (empty($_POST["url"])) {
        $errors["url"] = "URL is required";
    } else {
        $url = mysqli_real_escape_string($conn, $_POST["url"]);
    }

    $publication_date = '';
    if (!empty($_POST["publication_date"])) {
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST["publication_date"])) {
            $errors["publication_date"] = "Invalid date format";
        } else {
            $publication_date = mysqli_real_escape_string($conn, $_POST["publication_date"]);
        }
    }

    $site_name = mysqli_real_escape_string($conn, $_POST["site_name"]);
    $author_first_name = mysqli_real_escape_string($conn, $_POST["author_first_name"]);
    $author_middle_name = mysqli_real_escape_string($conn, $_POST["author_middle_name"]);
    $retrieval_date = mysqli_real_escape_string($conn, $_POST["retrieval_date"]);

    if (empty($errors)) {
      $sql = '';
      if(!empty($publication_date)){
        $sql = "INSERT INTO resources (title, url, author_first_name, publication_date, site_name, author_middle_name, author_last_name, retrieval_date) 
                VALUES ('$title', '$url', '$author_first_name', '$publication_date', '$site_name', '$author_middle_name', '$author_last_name', '$retrieval_date')";
      } else {
        $sql = "INSERT INTO resources (title, url, author_first_name, site_name, author_middle_name, author_last_name, retrieval_date) 
                VALUES ('$title', '$url', '$author_first_name', '$site_name', '$author_middle_name', '$author_last_name', '$retrieval_date')";
      }
      if(!empty($retrieval_date)){
        $sql = "INSERT INTO resources (title, url, author_first_name, publication_date, site_name, author_middle_name, author_last_name, retrieval_date) 
                VALUES ('$title', '$url', '$author_first_name', '$publication_date', '$site_name', '$author_middle_name', '$author_last_name', '$retrieval_date')";
      } else {
        $sql = "INSERT INTO resources (title, url, author_first_name, publication_date, site_name, author_middle_name, author_last_name) 
                VALUES ('$title', '$url', '$author_first_name', '$publication_date', '$site_name', '$author_middle_name', '$author_last_name')";
      }
      if(empty($publication_date) && empty($retrieval_date)){
        $sql = "INSERT INTO resources (title, url, author_first_name, site_name, author_middle_name, author_last_name) 
                VALUES ('$title', '$url', '$author_first_name', '$site_name', '$author_middle_name', '$author_last_name')";
      }

        if (mysqli_query($conn, $sql)) {
            echo "Record created successfully";
            header("Location: demo.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resource - Blogify</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <section>
            <h2>Add New Resource</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-field">
                    <label for="url">URL:</label>
                    <input type="text" id="url" name="url">
                    <span class="error"><?php echo isset($errors["url"]) ? $errors["url"] : ""; ?></span>
                </div>
                <div class="form-field">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title">
                    <span class="error"><?php echo isset($errors["title"]) ? $errors["title"] : ""; ?></span>
                </div>
                <div class="form-field">
                    <label for="author_first_name">Author First Name:</label>
                    <input type="text" id="author_first_name" name="author_first_name">
                    <span class="error"><?php echo isset($errors["author_first_name"]) ? $errors["author_first_name"] : ""; ?></span>
                </div>
                <div class="form-field">
                    <label for="publication_date">Publication Date (YYYY-MM-DD):</label>
                    <input type="date" id="publication_date" name="publication_date" required>
                    <span class="error"><?php echo isset($errors["publication_date"]) ? $errors["publication_date"] : ""; ?></span>
                </div>
                <div class="form-field">
                    <label for="retrieval_date">Retrieval Date:</label>
                    <input type="date" id="retrieval_date" name="retrieval_date">
                </div>
                <div class="form-field">
                    <label for="site_name">Site Name:</label>
                    <input type="text" id="site_name" name="site_name">
                </div>
                <div class="form-field">
                    <label for="author_middle_name">Author Middle Name:</label>
                    <input type="text" id="author_middle_name" name="author_middle_name">
                </div>
                <div class="form-field">
                  <button type="submit">Submit</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Blogify. All rights reserved.</p>
    </footer>
</body>
</html>
