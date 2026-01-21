<?php

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','password');
define('DB_NAME','forum_test');

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 3307);
if (!$con) {
    die("DB connection failed: " . mysqli_connect_error());
}

$tbl_name = "forum_answer";

// Validate ID
if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    die("Invalid topic ID");
}
$id = (int)$_POST['id'];

// Find highest answer number
$stmt = mysqli_prepare(
    $con,
    "SELECT MAX(a_id) FROM forum_answer WHERE question_id = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $Max_id);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$Max_id = ($Max_id ?? 0) + 1;

// Get form values
$a_name   = $_POST['a_name'] ?? '';
$a_email  = $_POST['a_email'] ?? '';
$a_answer = $_POST['a_answer'] ?? '';
$datetime = date("Y-m-d H:i:s");

// Insert answer
$stmt = mysqli_prepare(
    $con,
    "INSERT INTO forum_answer
     (question_id, a_id, a_name, a_email, a_answer, a_datetime)
     VALUES (?, ?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param(
    $stmt,
    "iissss",
    $id,
    $Max_id,
    $a_name,
    $a_email,
    $a_answer,
    $datetime
);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {

    // Increment reply count
    $stmt2 = mysqli_prepare(
        $con,
        "UPDATE forum_question SET reply = reply + 1 WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt2, "i", $id);
    mysqli_stmt_execute($stmt2);

    echo "Successful<br>";
    echo "<a href='view_topic.php?id=".$id."'>View your answer</a>";

} else {
    echo "Error inserting answer.";
}

mysqli_close($con);
