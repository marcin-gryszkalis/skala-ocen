<?
$minp = $_REQUEST['minp'];
$maxp = $_REQUEST['maxp'];
$sel_scale = $_REQUEST['sel_scale'];

if (!isset($minp)) $minp = 10;
if (!isset($maxp)) $maxp = 20;

if ($maxp < 5) $maxp = 5;
if ($minp < 5) $minp = 5;
if ($maxp > 1000) $maxp = 1000;
if ($minp > 1000) $minp = 1000;
if ($maxp < $minp) 
{
	$a = $maxp; $maxp = $minp; $minp = $a;
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head>
<style type="text/css">
body { 
	font-family: Tahoma, Arial, Helvetiva, sans-serif;
	color: #006000;
	font-size: 12px;
	padding: 0px;
	margin: 10px;
	background-color: #f8fff8;
	/* background-image: url('cage.png'); */
	}

a:link,a:visited
{
        color: #006000;
}

a:hover
{
        color: #40a040;
}

hr
{
		background-color: #006000;
}

td 
{ 
	vertical-align: top; 
	font-weight: bold;
}

input, select
{ 
	width: 400px;
}

table.res, tr.res, td.res, th.res
{
	border-collapse: collapse;
	border: 1px solid black;
	padding: 4px;
}
</style>
<title>Skala ocen</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<body>

<center>
<h1>Skala ocen</h1>
</center>

<form action="index.php"> 
<table>
<tr><td>od (5-1000)<td><input type="text" name="minp" value="<?=$minp ?>"><br>
<tr><td>do (5-1000)<td><input type="text" name="maxp" value="<?=$maxp ?>"><br>
<tr><td>skala<td><select name="sel_scale">
<option value="pa">SSP</option>
<option value="pb" selected>SSP+</option>
<!--
<option value="osm">OSM</option>
<option value="gi">Gimnazjum</option>
<option value="gi2">Gimnazjum+</option>
<option value="lo">Liceum</option>
<option value="lo2">Liceum+</option>
-->
</select>
<tr><td><td><input type="submit" value="oblicz">
</form>
</table>
<hr>

<?
if (isset($sel_scale)) 
{

	if ($sel_scale == "")
		$sel_scale = "pa";
	
	if ($sel_scale == "pb") // SSP+
	{
		$scale_size = 13; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 35;  $scale_n[1] = "1+"; 
		$scale[2] = 40;	$scale_n[2] = "2-";
		$scale[3] = 43;	$scale_n[3] = "2";
		$scale[4] = 50;	$scale_n[4] = "2+";
		$scale[5] = 52;	$scale_n[5] = "3-";
		$scale[6] = 57;	$scale_n[6] = "3";
		$scale[7] = 70;	$scale_n[7] = "3+";
		$scale[8] = 75;	$scale_n[8] = "4-";
		$scale[9] = 78;	$scale_n[9] = "4";
		$scale[10] = 85;	$scale_n[10] = "4+";
		$scale[11] = 90;	$scale_n[11] = "5-";
		$scale[12] = 95;	$scale_n[12] = "5";
		$scale[13] = 101;$scale_n[13] = "-"; // limiter
	}
    else if ($sel_scale == "pa")
	{
		$scale_size = 5; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 40;	$scale_n[1] = "2";
		$scale[2] = 52;	$scale_n[2] = "3";
		$scale[3] = 75;	$scale_n[3] = "4";
		$scale[4] = 90;	$scale_n[4] = "5";
		$scale[5] = 101;$scale_n[5] = "-"; // limiter
	}
	else if ($sel_scale == "osm")
	{
		$scale_size = 5; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 30;	$scale_n[1] = "2";
		$scale[2] = 46;	$scale_n[2] = "3";
		$scale[3] = 66;	$scale_n[3] = "4";
		$scale[4] = 86;	$scale_n[4] = "5";
		$scale[5] = 101;$scale_n[5] = "-"; // limiter

	}
	else if ($sel_scale == "gi")
	{
		$scale_size = 5; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 40;	$scale_n[1] = "2";
		$scale[2] = 51;	$scale_n[2] = "3";
		$scale[3] = 76;	$scale_n[3] = "4";
		$scale[4] = 91;	$scale_n[4] = "5";
		$scale[5] = 101;$scale_n[5] = "-"; // limiter

	}
	else if ($sel_scale == "gi2")
	{
		$scale_size = 8; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 40;	$scale_n[1] = "2";
		$scale[2] = 46;	$scale_n[2] = "2+";
		$scale[3] = 51;	$scale_n[3] = "3";
		$scale[4] = 71;	$scale_n[4] = "3+";
		$scale[5] = 76;	$scale_n[5] = "4";
		$scale[6] = 86;	$scale_n[6] = "4+";
		$scale[7] = 91;	$scale_n[7] = "5";
		$scale[8] = 101;$scale_n[8] = "-"; // limiter

	}
	else if ($sel_scale == "lo")
	{
		$scale_size = 5; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 50;	$scale_n[1] = "2";
		$scale[2] = 63;	$scale_n[2] = "3";
		$scale[3] = 76;	$scale_n[3] = "4";
		$scale[4] = 91;	$scale_n[4] = "5";
		$scale[5] = 101;$scale_n[5] = "-"; // limiter

	}
	else if ($sel_scale == "lo2")
	{
		$scale_size = 8; // w/o limiter
		$scale[0] = 0;  $scale_n[0] = "1"; 
		$scale[1] = 50;	$scale_n[1] = "2";
		$scale[2] = 56;	$scale_n[2] = "2+";
		$scale[3] = 63;	$scale_n[3] = "3";
		$scale[4] = 71;	$scale_n[4] = "3+";
		$scale[5] = 76;	$scale_n[5] = "4";
		$scale[6] = 86;	$scale_n[6] = "4+";
		$scale[7] = 91;	$scale_n[7] = "5";
		$scale[8] = 101;$scale_n[8] = "-"; // limiter

	}



	?>

	<table class="res">
	<tr><th>punkty
	<?
	for ($i = 0; $i < $scale_size; $i++)
	{
		echo "<th class='res'>".$scale_n[$i]." (od ".$scale[$i]."%)";
	}
	?>

	<?
	if ($minp <= 0) $minp = 1;
	if ($maxp < $minp) $maxp = $minp;

	for ($tp = $minp; $tp <= $maxp; $tp++) // tp - max points (eg. 15)
	{
		for ($i = 0; $i < $scale_size; $i++) 
    	{
    		$lp[$i] = $rp[$i] = -1;
    		$lpp[$i] = $rpp[$i] = -1;
    	}

    	echo "<tr class='res'><td class='res'>$tp";

        $i = 0; // current scale level (0..5 or so), monotonous 
        for ($p = 0; $p <= $tp; $p++) // p: 0..tp
		{
			$pcent = $p * 100 / $tp; // pcent: 0..100%
			if ($scale[$i] <= $pcent && $pcent < $scale[$i+1]) // inside current level
    		{
                if ($lp[$i] == -1) 
                {
                    $lp[$i] = $p; // set left boundary once
                    $lpp[$i] = sprintf("%.2f", $pcent);
                }
				$rp[$i] = $p;
				$rpp[$i] = sprintf("%.2f", $pcent);
			}
            else
            {
                $i++; $p--; // we're outside of $i-th level, move to next, decrese $p to reiterate
            }
        }

		for ($i = 0; $i < $scale_size; $i++) 
		{
            if ($lp[$i] == -1 && $rp[$i] == -1) // nothing on this level
			{
				echo "<td class='res'>.";
            }
            else if ($lp[$i] == $rp[$i]) // one particular value on this level
            {
                echo "<td class='res' title='".$lpp[$i]."%'>".$lp[$i];
            }
            else
            {
				echo "<td class='res' title='".$lpp[$i]."% - ".$rpp[$i]."%'>".$lp[$i]." - ".$rp[$i];
            }
		}

	}
	?>
	</table>

<?
}
?>

</body>
</html>
