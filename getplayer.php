<?php
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

$table = $_GET['t'].$_GET['m'];
$name = 'Player_Name';
$role = 'Player_Role';
$id = 'Player_ID';
if (isset($_GET['r1']))
{
    $query = $handler->query("SELECT ".$name.", ".$id." FROM ".$table." WHERE ".$role."='".$_GET['r1']."' OR ".$role."='".$_GET['r2']."'");
   // $sql_player = "SELECT ".$name." FROM ".$table." WHERE ?=? OR ?=?";
    //$query = $handler->prepare($sql_player);
    //$query->execute(array($role, $_GET['r1'], $role, $_GET['r2']));
}
else
{
    $query = $handler->query("SELECT ".$name.", ".$id." FROM ".$table." WHERE ".$role."='".$_GET['r']."'");
    //$sql_player = "SELECT ".$name." FROM ".$table." WHERE ".$role." = ".$_GET['r'];
    //$query = $handler->prepare($sql_player);
    //$query->execute(array($role, $_GET['r']));
}
$results = $query->fetchAll(PDO::FETCH_ASSOC);
print_r('
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="prova_style.css">
    <body>
<form>
    <select name="'.$table.'" onchange="chosen(this.value, this.name)">
    <option value="">Select a Player:</option>
    ');
      foreach ($results as $player)
      {
      print_r('
      <option value="'.$player[$id].'">'.$player[$name].'</option>
      ');
    }
    print_r('
     </select>
    </form>
	</body>
    </html>
    ');
	
?>