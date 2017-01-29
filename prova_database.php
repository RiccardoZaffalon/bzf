<?php
print_r('
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="prova_style.css">
    <body>
    <h1>Choose your team:</h1>
    </body>
    </html>
    ');
if (isset ($_POST['Launch']))
{
	print_r('<h2>Current Matchweek :');
	print_r($_POST['matchweek']);
	print_r('</h2></br>');
}
else
{
	print_r('
		<h2> 
		Which matchweek?</br>
		<form method="post">
		<input id="input" type="text" maxlength="2" value="" name="matchweek" />
		<input type="submit" name="Launch" value="OK">
		</form>
		Define formation
		</h2>
		');
}
print_r('
	<h3>
	<form action="scelta_gioc.php" method="post">
	3-4-3 <input type="checkbox" name="formation" value="343" /></br>
	3-5-2 <input type="checkbox" name="formation" value="352" /></br>
	4-3-3 <input type="checkbox" name="formation" value="433" /></br>
	4-4-2 <input type="checkbox" name="formation" value="442" /></br>
	4-5-1 <input type="checkbox" name="formation" value="451" /></br>
	5-4-1 <input type="checkbox" name="formation" value="541" /></br>
	5-3-2 <input type="checkbox" name="formation" value="532" /></br>
	<input type="submit" value="Submit Formation">
	');
if (isset ($_POST['matchweek']))
{
	print_r('
	<input type="hidden" name="match" value="'. $_POST['matchweek'].'">
	</form>
	</h3>
	');
}
?>
