<?php


 $mysqli = new mysqli('localhost', 'root', '', 'ivac_operation');
if ($mysqli->connect_errno)
{
	echo "Sorry, this website is experiencing problems. Error: Failed to make a MySQL connection, here is why: \n Errno: " . $mysqli->connect_errno . "\nError: " . $mysqli->connect_error . "\n";
	exit;
} 


$conn = mysqli_connect("localhost","root","","ivac_operation");
if(!$conn)
{
   die('Error'.mysqli_connect_error());
}




	?>