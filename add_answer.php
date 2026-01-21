<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','password');
define('DB_NAME','forum_test');

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3307);
if (!$con) {
    die("DB connection failed: " . mysqli_connect_error());
}

// Validate ID
if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    die("Invalid topic ID");
}
$id = (int)$_POST['id'];

// Get form values
$a_name   = $_POST['a_name'] ?? '';
$a_email  = $_POST['a_email'] ?? '';
$a_answer = $_POST['a_answer'] ?? '';
$datetime = date("Y-m-d H:i:s");

// Insert answer
$stmt = mysqli_prepare(
    $con,
    "INSERT INTO forum_answer
     (question_id, a_name, a_email, a_answer, a_datetime)
     VALUES (?, ?, ?, ?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "issss",
    $id,
    $a_name,
    $a_email,
    $a_answer,
    $datetime
);

mysqli_stmt_execute($stmt);

// Increment reply count
$stmt2 = mysqli_prepare(
    $con,
    "UPDATE forum_question SET reply = reply + 1 WHERE id = ?"
);
mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);

echo "Successful<br>";
echo "<a href='view_topic.php?id=".$id."'>View your answer</a>";

mysqli_close($con);
