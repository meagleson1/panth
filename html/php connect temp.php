<html>
<head>
<title>Connecting to the MySQL Server Using PHP and the Database</title>
</head>
<body>

<?php
$link = mysqli_connect("localhost", "root", "Freerut849", "Bayside_Camp");

if (!$link) {

	echo "Error: Unable to connect to MYSQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

echo "Success: A proper connection to MySQL was made! The Bayside_Camp database is great." . PHP_EOL;
echo "Host Information: " . mysqli_get_host_info($link) . PHP.EOL;
echo " ";
echo " ";
$query = "SELECT * FROM PART";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_array($result, MYSQLI_NUM);
printf ("%s (%s)\n", $row[0],$row[1]);
printf ("%s (%s)\n", $row[1],$row[2]);



mysqli_close($link)
?>

</body>
</html>