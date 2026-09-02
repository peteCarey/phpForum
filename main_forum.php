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

       $tbl_name = "forum_question";

        require_once "database.php";

        $sql = "SELECT * FROM $tbl_name ORDER BY id DESC";

            $result = mysqli_query($con, $sql);

        if (!$result) {
            die("Forum database query failed: " . mysqli_error($con));
        }



/* $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo "FIRST ROW:<br><br>";

echo "ID: " . $rows['id'] . "<br>";
echo "Topic: " . htmlspecialchars($rows['topic'], ENT_QUOTES, 'UTF-8') . "<br>";
echo "Detail: " . htmlspecialchars($rows['detail'], ENT_QUOTES, 'UTF-8') . "<br>";
echo "Name: " . htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8') . "<br>";
echo "Email: " . htmlspecialchars($rows['email'], ENT_QUOTES, 'UTF-8') . "<br>";
echo "Date/Time: " . htmlspecialchars($rows['datetime'], ENT_QUOTES, 'UTF-8') . "<br>";

mysqli_close($con); */

       
    ?>
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

            <tr>
                <td width="6%" align="center" bgcolor="#E6E6E6">
                    <strong>#</strong>
                </td>

                <td width="40%" align="center" bgcolor="#E6E6E6">
                    <strong>Topic</strong>
                </td>

                <td width="15%" align="center" bgcolor="#E6E6E6">
                    <strong>Detail</strong>
                </td>

                <td width="13%" align="center" bgcolor="#E6E6E6">
                    <strong>Name</strong>
                </td>

                <td width="13%" align="center" bgcolor="#E6E6E6">
                    <strong>Email</strong>
                </td>

                <td width="13%" align="center" bgcolor="#E6E6E6">
                    <strong>Date/Time</strong>
                </td>
            </tr>

    <?php

    while ($rows = mysqli_fetch_assoc($result)) {

    ?>
            <tr>
             <td bgcolor="#FFFFFF">
                        <?php echo htmlspecialchars($rows['id'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>

                <td bgcolor="#FFFFFF">
                    <a href="view_topic.php?id=<?php echo (int)$rows['id']; ?>">
                        <?php echo htmlspecialchars($rows['topic'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </td>

                <td bgcolor="#FFFFFF">
                    <?php echo htmlspecialchars($rows['detail'], ENT_QUOTES, 'UTF-8'); ?>
                </td>

                <td align="center" bgcolor="#FFFFFF">
                    <?php echo htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8'); ?>
                </td>

                <td align="center" bgcolor="#FFFFFF">
                    <?php echo htmlspecialchars($rows['email'], ENT_QUOTES, 'UTF-8'); ?>
                </td>

                <td align="center" bgcolor="#FFFFFF">
                    <?php echo htmlspecialchars($rows['datetime'], ENT_QUOTES, 'UTF-8'); ?>
                </td>
            </tr>

            <?php
        
        }
    mysqli_close($con);
    ?>

     <tr>
                <td colspan="6" align="right" bgcolor="#E6E6E6">
                    <a href="create_topic.php">
                        <strong>Create New Topic</strong>
                    </a>
                </td>
            </tr>
    </table>

        </div>
    <div class="footer">
        <a href="../../index.html">Exit Forum</a>
    </div>

    </body>
</html>