 <?php

$tbl_name="forum_question"; // Table name

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'forum_test');

// Connect to server and select database.
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


//$sql="SELECT * FROM $tbl_name";
$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// ORDER BY id DESC is order result by descending

$result=mysqli_query($con, $sql);
?>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>

<?php
// Start looping table row (for each)
//$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
//echo "posts " ;
//var_dump($rowss);


	
		# code...
		//$id = $rows['id'];
		//$topic = $rows['topic'];
	 	//$view = $rows['view'];
	  	//$reply = $rows['reply'];
	  	//$datetime = $rows['datetime'];
	While ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){echo $rows['id'] //remove idc
		?>
		<tr>
		<td bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
		<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<?php echo $rows['id']; ?>"><?php echo $rows['topic']; ?></a><BR></td>
		<td align="center" bgcolor="#FFFFFF"><?php echo $rows['view']; ?></td>
		<td align="center" bgcolor="#FFFFFF"><?php echo $rows['reply']; ?></td>
		<td align="center" bgcolor="#FFFFFF"><?php echo $rows['datetime']; ?></td>
		</tr>

		<?php
		// Exit looping and close connection
	}
mysqli_close($con);
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Create New Topic</strong> </a></td>
</tr>
</table>