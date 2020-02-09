<?php

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'forum_test');
$tbl_name="forum_answer"; // Table name
$id="";
// Connect to server and select database.
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Get value of id that sent from hidden field
$id = $_POST['id'];


// Find highest answer number.
$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
$result=mysqli_query($con, $sql);

$rows=mysqli_fetch_array($result, MYSQLI_BOTH); 

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}

// get values that sent from form
$a_name=$_POST['a_name'];
$a_email=$_POST['a_email'];
$a_answer=$_POST['a_answer'];

$datetime=date("d/m/y H:i:s"); // create date and time


// Insert answer
$sql2="INSERT INTO $tbl_name(question_id, a_id, a_name, a_email, a_answer, a_datetime)VALUES('$id', '$Max_id', '$a_name', '$a_email', '$a_answer', '$datetime')";

$result2=mysqli_query($con, $sql2);

if($result2){
echo "Successful<BR>";
echo "<a href='view_topic.php?id=".$id."'>View your answer</a>";

//echo "id is ".$id


// If added new answer, add value +1 in reply column

$tbl_name2 ="forum_question";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
$result3=mysqli_query($con, $sql3);
}
else {
echo "ERROR";
}

// Close connection
mysqli_close($con);
?>