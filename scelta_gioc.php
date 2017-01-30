<?php
print_r('
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="prova_style.css">
    <body>
    <h1>Choose your team:</h1>
    </html>
    ');
if (isset ($_POST['formation']))
{
	$form = str_split($_POST['formation']);
	$dif = $form[0];
	$cc = $form[1];
	$att = $form[2];
	$j = 1;
	print_r('</br><p>PORTIERE :</p>');
	print_r('
	<script>
	function showUser'.$j.'(str) {
		var match="'); print_r($_POST['match']); print_r('";
		var por="Por";
	    if (str == "") {
	        document.getElementById("txtHint'.$j.'").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint'.$j.'").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","getplayer.php?t="+str+"&m="+match+"&r="+por,true);
	        xmlhttp.send();
	    }
	}
	</script>

	<form id="ciao">
	<select name="users" onchange="showUser'.$j.'(this.value)">
	<option value="">Select a Team:</option>
	');
	$teams=array('atalanta','bologna','cagliari','chievo','crotone','empoli','fiorentina','genoa','inter','juventus','lazio','milan','napoli','palermo','pescara','roma','sampdoria','sassuolo','torino','udinese' );
	  
	  foreach ($teams as $team)
	  {
	  print_r('
	  <option value="'.$team.'">'.$team.'</option>
	  ');
	}
	print_r('
	 </select>
	</form>
	
	<div class="dio"; id="txtHint'.$j.'"><b>Players will be listed here...</b></div></br></br>
	');
	++$j;
	print_r('</br><p>DIFENSORI ('.$dif.') :</p>');
	for ($i = 1; $i <= $dif; ++$i)
	{
	print_r('
	<script>
	function showUser'.$j.'(str) {
		var match="'); print_r($_POST['match']); print_r('";
		var dif="Dif";
	    if (str == "") {
	        document.getElementById("txtHint'.$j.'").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint'.$j.'").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","getplayer.php?t="+str+"&m="+match+"&r="+dif,true);
	        xmlhttp.send();
	    }
	}
	</script>
	
	<form id="ciao">
	<select name="users" onchange="showUser'.$j.'(this.value)">
	<option value="">Select a Team:</option>
	');
	$teams=array('atalanta','bologna','cagliari','chievo','crotone','empoli','fiorentina','genoa','inter','juventus','lazio','milan','napoli','palermo','pescara','roma','sampdoria','sassuolo','torino','udinese' );
	  
	  foreach ($teams as $team)
	  {
	  print_r('
	  <option value="'.$team.'">'.$team.'</option>
	  ');
	}
	print_r('
	 </select>
	</form>
	
	<div class="dio"; id="txtHint'.$j.'"><b>Players will be listed here...</b></div></br></br>
	');
	++$j;
	}

	print_r('</br><p>CENTROCAMPISTI ('.$cc.') :</p>');
	for ($i = 1; $i <= $cc; ++$i)
	{
	print_r('
	<script>
	function showUser'.$j.'(str) {
		var match="'); print_r($_POST['match']); print_r('";
		var cen="Cen";
		var tre="Tre";
	    if (str == "") {
	        document.getElementById("txtHint'.$j.'").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint'.$j.'").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","getplayer.php?t="+str+"&m="+match+"&r1="+cen+"&r2="+tre,true);
	        xmlhttp.send();
	    }
	}
	</script>
	
	<form id="ciao">
	<select name="users" onchange="showUser'.$j.'(this.value)">
	<option value="">Select a Team:</option>
	');
	$teams=array('atalanta','bologna','cagliari','chievo','crotone','empoli','fiorentina','genoa','inter','juventus','lazio','milan','napoli','palermo','pescara','roma','sampdoria','sassuolo','torino','udinese' );
	  
	  foreach ($teams as $team)
	  {
	  print_r('
	  <option value="'.$team.'">'.$team.'</option>
	  ');
	}
	print_r('
	 </select>
	</form>
	<div class="dio">
	<div id="txtHint'.$j.'"><b>Players will be listed here...</b></div></div></br></br>
	');
	++$j;
	}
	print_r('</br><p>ATTACCANTI ('.$att.') :</p>');
	for ($i = 1; $i <= $att; ++$i)
	{
	print_r('
	<script>
	function showUser'.$j.'(str) {
		var match="'); print_r($_POST['match']); print_r('";
		var att="Att";
		var tre="Tre";
	    if (str == "") {
	        document.getElementById("txtHint'.$j.'").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("txtHint'.$j.'").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","getplayer.php?t="+str+"&m="+match+"&r1="+att+"&r2="+tre,true);
	        xmlhttp.send();
	    }
	}
	</script>

	<form id="ciao">
	<select name="users" onchange="showUser'.$j.'(this.value)">
	<option value="">Select a Team:</option>
	');
	$teams=array('atalanta','bologna','cagliari','chievo','crotone','empoli','fiorentina','genoa','inter','juventus','lazio','milan','napoli','palermo','pescara','roma','sampdoria','sassuolo','torino','udinese' );
	  
	  foreach ($teams as $team)
	  {
	  print_r('
	  <option value="'.$team.'">'.$team.'</option>
	  ');
	}
	print_r('
	 </select>
	</form>
	
	<div class="dio"; id="txtHint'.$j.'"><b>Players will be listed here...</b></div></br></br>
	');
	++$j;
	}
}
print_r('</body>');
print_r('<script>
		 var players = [];
		 var teams = [];
		 var i = 0;
		 function chosen(pla,name)
		 {
		 	if (pla != "") 
		 	{
		 		players[i] = pla;
		 		teams[i] = name;
		 		++i;
				if (players.length == 11)
		 		{
					window.location.href = "results.php?pla="+players.join(",")+"&t="+teams.join(",");
				}
			}

		}
		 </script>
		');

?>
