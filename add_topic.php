<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Forum</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="forum.css">
<style>
* {
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

</style>
</head>
<body>
    <div class="topnav">
        <a href="../../index.html">Exit Forum</a> 
        <a href="./create_topic.php">Create New Topic</a> 
    </div>

    <div class="content">
<?php

$tbl_name="forum_question"; // Table name

require_once "database.php";

date_default_timezone_set('Europe/London');

// get data that sent from form
$topic  = trim($_POST['topic'] ?? '');
$detail = trim($_POST['detail'] ?? '');
$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');

if ($topic === '' || $detail === '' || $name === '' || $email === '') {
    die("Please complete all required fields.");
}

$datetime = date("Y-m-d H:i:s");
// Prepared statement - protects against SQL injection
$sql = "INSERT INTO $tbl_name 
        (topic, detail, name, email, datetime)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die("Database error: " . mysqli_error($con));
}

mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $topic,
    $detail,
    $name,
    $email,
    $datetime
);

$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die("Unable to create topic: " . mysqli_stmt_error($stmt));
}

echo "Successful<br>";
echo '<a href="main_forum.php">View your topic</a>';
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
    </table>

        </div>
    <div class="footer">
        <a href="../../index.html">Exit Forum</a>
    </div>

    </body>
</html>