<?php
$db_host = "localhost";
$db_name = "prova";
$db_username = "root";
$db_password = "";
for ($match = 21; $match <= 21; ++$match)
{
	$csv_file = "data_".$match.".csv";
	$delimiter = ",";
	if(!file_exists($csv_file)) 
	{
	 	die("File not found. Make sure you specified the correct path.");
	}
	try
	{
	 	$handler = new PDO("mysql:host=$db_host;dbname=$db_name",$db_username,$db_password);
	 	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) 
	{
		die("database connection failed: ".$e->getMessage());
	}
	$file = fopen($csv_file, "r");
	$team_bef='team';
	while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
	{
		foreach ($data as $dat)
		{	
			if ($dat == '-')
			{
				$dat = '0';
			}
		}
		$name = $data[0];
		$team = $data[1];
		$number = $data[2];
		$complete_name = $data[3];
		$id = $data[4];
		$role = $data[5];
		$V = $data[6];
		$G = $data[7];
		$A = $data[8];
		$R = $data[9];
		$RS = $data[10];
		$AG = $data[11];
		$AM = $data[12];
		$ES = $data[13];
		$FV = $data[14];
		$team_name=$team.$match;

		if ($team != 'team')
		{
			if ($team != $team_bef)
			{
				$sql = "DROP TABLE if exists ".$team_name;
				$handler->query($sql);
				$sql_team = "CREATE TABLE if not exists ".$team_name." (Player_ID VARCHAR(20), Player_Name VARCHAR(20), Team VARCHAR(20), Player_Number VARCHAR(20), Complete_Name VARCHAR(30), Player_Role VARCHAR(4), V VARCHAR(20), G  VARCHAR(20), A VARCHAR(20), R VARCHAR(20), RS VARCHAR(20), AG VARCHAR(20), AM VARCHAR(20), ES VARCHAR(20), FV VARCHAR(20))";
				$handler->query($sql_team);
			}
			$sql_val = "INSERT INTO ".$team_name." VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$query = $handler->prepare($sql_val);
			$query->execute(array($id, $name, $team, $number, $complete_name, $role, $V, $G, $A, $R, $RS, $AG, $AM, $ES, $FV));
			$team_bef = $team;
		}
	}
	fclose($file);
}
?>

