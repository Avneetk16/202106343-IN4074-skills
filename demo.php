<?php
include 'config.php';

$query = "SELECT * FROM resources";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - Employee Record Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div>
            <h2>Resources</h2>
            <div class="d-flex justify-content-end my-2">
                <a href="create.php" class="btn">Add New Resource</a>
            </div>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="resource">';
                    if (!empty($row['author_first_name'])) {
                        $publication_date = isset($row['publication_date']) ? date("Y, F j", strtotime($row['publication_date'])) : "n.d.";
                        echo '<p class="citation">' . $row['author_first_name'] . 
                        (!empty($row['author_middle_name']) ? ' ' . strtoupper(substr($row['author_middle_name'], 0, 1)) . '.' : '') . 
                        ' (' . $publication_date . '). ' . 
                        $row['title'] . '. ' . 
                        $row['site_name'] . 
                        '<a target="_blank" href="' . $row['url'] . '">' . $row['url'] . '</a></p>';
                    } else {
                        if (!empty($row['publication_date'])) {
                            echo '<p class="citation">' . $row['title'] . '. (' . date("Y, F j", strtotime($row['publication_date'])) . '). ' . $row['site_name'] . '. Retrieved ' . date("j F, Y", strtotime($row['retrieval_date'])) . ', from <a target=_blank href='.$row['url'].'>' . $row['url'] . '</a></p>';
                        } else {
                            echo '<p class="citation">' . $row['title'] . '. (n.d.). ' . $row['site_name'] . '. ' . $row['url'] . '</p>';
                        }
                    }
                    ?>
                    <div class="d-flex justify-content-center">
                      <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                      <a class="btn btn-danger" onclick="confirmDeletion(<?php echo $row['id']; ?>)">Delete</a>
                    </div>
                    <?php
                    echo '</div><br>';
            ?>
            <?php
                }
            } else {
                echo '<p>No resources found.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Employee Record Management System. All rights reserved.</p>
    </footer>
    <script>
        function confirmDeletion(id) {
            if(confirm("Are you sure you want to delete this resource?")) {
              window.location.href = `delete.php?id=${id}`;
            } else {
              return false
            }
        }
    </script>
</body>
</html>
