<?php
print_r('
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="prova_style.css">
    <body>
    <h2>Your Team:  
    ');
$players=explode(",", $_GET['pla']);
$tables=explode(",", $_GET['t']);
$db_host = "localhost";
$db_name = "prova";
$db_username = "root";
$db_password = "";
try
    {
        $handler = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
        $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch (PDOException $e) 
    {
        die("database connection failed: ".$e->getMessage());
    }
$name = 'Player_Name';
$role = 'Player_Role';
$id = 'Player_ID';
$results = array();
foreach ($tables as $key => $table)
{
	 $sql_player = "SELECT * FROM ".$table." WHERE ".$id." = ?";
     $query = $handler->prepare($sql_player);
     $query->execute(array($players[$key]));
     $results[$key] = $query->fetchAll(PDO::FETCH_ASSOC);
}
$total_points=0;
foreach ($results as $player)
{
    $total_points+=$player[0]['FV'];
}
print_r('        '.$total_points.' Points</h2>');
?>

<table style="width:100%">
  <tr>
  	<th>ID</th>
    <th>Name</th>
    <th>Team</th> 
    <th>Number</th>
    <th>Complete Name</th>
    <th>Role</th> 
    <th>V</th>
    <th>G</th> 
    <th>A</th>
    <th>R</th>
    <th>RS</th> 
    <th>AG</th>
    <th>AM</th>
    <th>ES</th> 
    <th>FV</th>
  </tr>
 <?php
 foreach ($results as $player)
 {
 	echo '<tr>';
 	foreach ($player[0] as $stat)
 	{
 		echo '<th>';
 		print_r($stat);
 		echo '</th>';
 	}
 	echo '</tr>';
 }
 ?>
</body>
</html>