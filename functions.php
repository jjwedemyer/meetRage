<?php
require 'db_conf.inc.php';
function checkuser($fuid,$ffname,$femail){
    	$check = mysql_query("select * from Users where uuid='$fuid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record
	$query = "INSERT INTO Users (uuid,realname,mail) VALUES ('$fuid','$ffname','$femail')";
	mysql_query($query);
	} else {   // If Returned user . update the user record
	$query = "UPDATE Users SET realname='$ffname', mail='$femail' where uuid='$fuid'";
	mysql_query($query);
	}
}?>
