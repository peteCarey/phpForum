<?php
session_start();

// Create a unique token for this form
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Record when the form was displayed
$_SESSION['topic_form_time'] = time();
?>

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

/* Honeypot - genuine visitors should never see or fill this */
.website-field {
    position: absolute;
    left: -9999px;
    width: 1px;
    height: 1px;
    overflow: hidden;
}

</style>
</head>

<body>
    <div class="topnav">
        <a href="../../index.html">Exit Forum</a> 
    </div>

    <div class="content">
 
        <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" >
            <tr>
                <form id="form1" name="form1" method="post" action="add_topic.php">
                    <td>
                        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                            <tr>
                                <td colspan="3" bgcolor="#E6E6E6"><strong>Create New Topic</strong> </td>
                            </tr>
                            <tr>
                                <td width="14%"><strong>Topic</strong></td>
                                <td width="2%">:</td>
                                <td width="84%">
                                    <input name="topic" type="text" id="topic" size="50" maxlength="150"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Detail</strong></td>
                                <td valign="top">:</td>
                                <td><textarea 
                                        name="detail" cols="50" rows="3" id="detail  maxlength="5000"
                                        required">
                                    </textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td>:</td>
                                <td>
                                <input name="name" type="text" id="name" size="50" maxlength="100"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>:</td>
                                <td>
                                    <input name="email" type="text" id="email" size="50" maxlength="254"
                                        required />
                                </td>
                            </tr>
                             <!-- Honeypot field -->
                            <div class="website-field">
                                <label for="website">Website</label>
                                <input
                                    type="text"
                                    name="website"
                                    id="website"
                                    tabindex="-1"
                                    autocomplete="off"
                                >
                            </div>

                            <!-- CSRF token -->
                            <input
                                type="hidden"
                                name="csrf_token"
                                value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>"
                            >
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    <input type="submit" name="Submit" value="Submit" /> 
                                    <input type="reset" name="Submit2" value="Reset" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </form>
            </tr>
        </table>
    </div>
    <div class="footer">
        <a href="../../index.html">Exit Forum</a>
    </div>
</body>
</html>
