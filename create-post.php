<?php

    // create a sqli connection

    // use .env variables
    $host = getenv('PHA_HOST');
    $db_username = getenv('MYSQL_USER');
    $db_password = getenv('MYSQL_PASSWORD');
    $db_name = getenv('MYSQL_DATABASE');

    $connect = mysqli_connect(
        'db', 
        'php_docker', 
        'password', 
        'php_docker'
    );

    if (!$connect) { # mysqli error handling
        die('Connection failed...' . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { # check for request method
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $content = $_POST['content'];
        $user_id = 1; 
        $date_posted = date('Y-m-d');
        $create_post = "INSERT INTO Posts (user_id, first_name, last_name, content, date_posted) VALUES ('$user_id', '$first_name', '$last_name', '$content', '$date_posted')";
        $response = mysqli_query($connect, $create_post);

        // If the mysqli_query response is successful 
        // Show a success message
        if ($response) {
            echo "<p style='color: green;'> Post created successfully </p>";
        } else { # If mysql query fails display a failed message
            echo "<p style='red: green;'> Error creating new post: " . mysqli_error($connect) . "</p>";
        }
    }

    // close mysqli connection 
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
</head>
<body>
    <h1>Create a Post</h1>
    <!-- new post form -->
    <div class="form-container">
        <form method="POST" class="post-form">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last-name"required>

            <label for="content">Content</label>
            <input type="text" name="content">

            <input type="hidden" name="date_posted" value="<?php echo date('Y-m-d'); ?>">


            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>