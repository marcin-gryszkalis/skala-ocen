<?
$maxin = $_REQUEST['maxin'];
$maxout = $_REQUEST['maxout'];

if (!isset($maxin)) $maxin = 20;
if (!isset($maxout)) $maxout = 5;

if ($maxin > 1000) $maxin = 1000;
if ($maxout > 1000) $maxout = 1000;

if ($maxin < 1) $maxin = 1;
if ($maxout < 1) $maxout = 1;

$half = isset($_REQUEST['half']);

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
/*	width: 400px; */
}

table.res, tr.res, td.res, th.res
{
	border-collapse: collapse;
	border: 1px solid black;
	padding: 4px;
}
</style>
<title>Skala ocen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<center>
<h1>Skala punktowa</h1>
</center>

<form action="procent.php"> 
<table>
<tr><td>Maksymalna liczba punktów z pracy ucznia <td><input type="text" name="maxin" value="<?=$maxin ?>"><br>
<tr><td>Maksymalna liczba punktów w systemie <td><input type="text" name="maxout" value="<?=$maxout ?>"><br>
<tr style='text-align: left'><td>Połówki punktów<sub style='font-weight: normal; font-size: 8px'>&lt;0.25,0.75)</sub><td style='text-align: left'><input type='checkbox' name='half' <?=$half ? " checked " : "" ?> >&nbsp;
<tr><td><td><input type="submit" value="oblicz">
</form>
</table>
<hr>

<table class="res">
<tr>
    <th class="res">punkty z pracy ucznia
    <th class="res">punkty w systemie
<tr>

<?

function xround($x, $tohalf)
{
    if (!$tohalf)
    {
        $x = round($x);
    }
    else # [0,0.25)=0 [0.25,0.75)=0.5 [0.75,1]=1
    {
        $outint = floor($x);
        $outmod = fmod($x, 1); # fp modulo, 567.123 -> 0.123
        
        if ($outmod < 0.25) { $x = $outint; }
        else if ($outmod < 0.75) { $x = $outint+0.5; }
        else { $x = $outint + 1; }
    }

    return $x;
}

$prev = -1;
$first = true;
$s = 0; # range is s-t (or s itself)
$t = 0;
for ($i = 0; $i <= $maxin; $i++)
{

    $out = $i * $maxout / $maxin;
    $out = xround($out, $half);

    if ($out != $prev) # stepped into new range
    {
        if (!$first) # write prev. row
        {   
            ?>
            <tr class='res'>
                
                <td class='res'>
                <? if ($s != $t) { print "$s - $t"; } else { print "$s"; } ?>
                <td class='res'><?=$prev ?>
            <?

            $s = $i;
            $t = $i;
        }
        else # first row
        {
            $first = false;
        }
            
        $prev = $out;
    }
        
    $t = $i;
}

# last row
?>
            <tr class='res'>
                <td class='res'>
                <? if ($s != $t) { print "$s - $t"; } else { print "$s"; } ?>
                <td class='res'><?=$out ?>



</table>
<hr>
<h1>Dokładna analiza</h1>
	<table class="res">
	<tr>
        <th class="res">punkty z pracy ucznia
        <th class="res">punkty w systemie
        <th class="res">punkty 1/10
        <th class="res">punkty rzeczywiste
    <tr>

	<?
	for ($i = 0; $i <= $maxin; $i++)
	{

        $out = $i * $maxout / $maxin;
        $outint = xround($out, $half);
        $out5 = round($out, 1);

        ?>
          	<tr class='res'>
                <td class='res'><?=$i ?>
                <td class='res'><?=$outint ?>
                <td class='res'><?=$out5 ?>
                <td class='res'><?=$out ?>
        <?
	}
	?>

	</table>

</body>
</html>
