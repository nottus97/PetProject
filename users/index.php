<?php
/*Secured user only page*/
include '../includes/constant/config.inc.php';
secure_page();

return_meta("Welcome to the secured user area " .$_SESSION['fullname'] . "!");
?>
<html>
<head>
<title>Home</title></head>
<body>
<div id="container">

	<?php include '../includes/constant/nav.inc.php';
	?>

	<h1>Your name is <?php echo $_SESSION['fullname']; ?>!</h1>

	<p>Your user id is <?php echo $_SESSION['user_id']; ?></p>

	<p>Here is the information we store when a user logs in successfully:</p>

	<pre><?php print_r($_SESSION); ?></pre>

	<?php
	$s = mysql_query("SELECT * FROM ".USER_DETAILS." WHERE detail_user_id = '".$_SESSION['user_id']."'") or die(mysql_error());
	if(mysql_num_rows($s) != 0)
	{
		echo "<h1>The database has this to say...</h1>";
		while($r = mysql_fetch_array($s))
		{
			echo "<p>".nl2br($r['detail_notes'])."</p>";
			echo "<hr />";
		}
	}
	else
	{
		echo "<p>No details found.</p>";
	}
	?>

<p>This is the page where the user will see their information and their status:</p>
<ul>
	<li><strong>Client status:</strong> The pet owner will have a message like "You have not yet been matched.", "A volunteer has sent you an email about a possible match.", or "You are currently matched with 'John Doe' [link to current match page for more information]."</li>
	
	<li><strong>Volunteer status:</strong> The volunteer will have a message like "You have not yet initiated a match.", "You have sent an email to 'Jane Doe' about a possible match for your services.", or "You are currently matched with 'Jane Doe''John Smith' [link to current match page for more information]."</li>
	
	<li><strong>User information:</strong> The client or volunteer will see their current user and pet/service information and will be able to update it on the [users/profile.php?] page."</li>
</ul>
	
	
</div>
</body>
</html>