<?php

$tbl_name="forum_question"; // Table name

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'forum_test');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Create connection
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);


if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// get data that sent from form
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$_POST['name'];
$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";

$result=mysqli_query($con, $sql);

// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
	
    $message  = 'Invalid query: ' . mysqli_error($con) . "\n";
    $message .= 'Whole query: '; // . $query;
    die($message);
}
if($result){
echo "Successful<BR>";
echo "<a href = main_forum.php>View your topic</a>";
}
else {
echo "ERROR";
}
mysqli_close($con);
?>