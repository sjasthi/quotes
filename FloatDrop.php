<?php $page_title = ' Double Puzzle'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	include ("telugu_parser.php");
		error_reporting(0);
?>
<head>
<div class="container">
<style>.title {text-align: center; color: darkgoldenrod;}

  .words {
            height: 50px;
            text-align: center;
        }
        
        h1,
        h2,
        h3 {
            text-align: center;
        }
        
        table {
            border: 1px solid black;
            border-collapse: separate;
            table-layout: fixed;
            width: 100px;
            height: 200px;
            text-align: center;
        }
        
        table td,
        table th {
            font-size: 20px;
            padding: 10px;
        }
        
        .answerkey td {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            padding: none
    </style>
</head>
<?php
//error_reporting(0);
include_once 'db_credentials.php'; 

  $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";
$flagged=true;
$spaces=array();
$touched=isset($_POST['ident']);
$touched2 = isset($_POST['first']);
if (!$touched ||!$touched2) {
	echo 'You need to select an entry. Go back and try again. <br>';
	
	?>
		  <button><a class="btn btn-sm" href="list.php">Go back</a></button>
<?php    } else {     $id = $_POST['first'];


    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    
$id2=$_POST['ident'];

$sql2="SELECT * FROM quote_table
            WHERE id = '$id2'";
	
}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
	}
		 echo '<h2 id="title">Double Puzzle</h2><br>';
	$norows = 16; 
	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	while ($row2 =mysqli_fetch_array($result2))
	{
		$norows=$row2["value"];
		
	}
	
	
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()){
$result3 = mysqli_query($db,$sql2);
$quoteline = $row["quote"];
while ($row3 = mysqli_fetch_array($result3)){

$quoteline2 = $row3["quote"]; }

	//makes an array from the line
	$arrayfod=parsetoCodePoints($quoteline);
	$noletters=count($arrayfod);
	

       $fodder=($norows-($noletters%$norows));
	   $trash=array(" ");
	for ($arrayfod2=0;$arrayfod2<$fodder+1;$arrayfod2++)
	{array_push($arrayfod, $trash);
	}
	$nohope=$noletters;
		$noletters=$noletters+$fodder;
	
	
	$sample=array();
	$wheeloffortune =array_fill(0,$norows,$sample);
	

	for ($x = 0;$x < $noletters;$x++)
	{
		
	$tested =parseToCharacter($arrayfod[$x]);
	
if (ctype_space($tested)==false && ctype_punct($tested)==false&&$x<$nohope)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$norows;
		//array_push($wheeloffortune[$t],"-");
		array_push($spaces,$x);
	}
	}
	
	$arrayfod=parsetoCodePoints($quoteline2);
	$noletters2=count($arrayfod);
	   $fodder=($norows-($noletters2%$norows));
		for ($arrayfod2=0;$arrayfod2<$fodder+1;$arrayfod2++)
	{array_push($arrayfod, $trash);
	}
	$nohope2=$noletters2;
	$noletters2=$noletters2+$fodder;
	
	
		for ($x = 0;$x < $noletters2;$x++)
	{
		
	$tested =parseToCharacter($arrayfod[$x]);
	
if (ctype_space($tested)==false && ctype_punct($tested)==false&&$x<$nohope2)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$norows;
		//array_push($wheeloffortune[$t],"-");
		array_push($spaces,$x+$noletters);
	}
	}
	
	
	
	foreach ($wheeloffortune as $axe)
	{
		shuffle ($axe);
	}

	
	
	
	
	
	
	
	
	}
	
	



	}
	?>
<body>
<table border="1" style="width:100%">
<tbody>

<?php
for ($y=0;$y<$noletters;$y++)
{
if ($y%$norows==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$norows][$y/$norows];

echo "<td>$alpha</td>";

if ($y%$norows==$norows-1) 
{ echo "</tr>";
}
}
	

	

 
		
?>
  <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=0;$y<$noletters;$y++)
{
if ($y%$norows==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$norows][$y/$norows];
if (in_array($y,$spaces)==false){
echo "<td></td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
	</td>";}

if ($y%$norows==$norows-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";

	 ?>

	 <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=$noletters;$y<$noletters+$noletters2;$y++)
{
if ($y%$norows==0)
{ echo "<tr>";
}	

if (in_array($y,$spaces)==false){
echo "<td></td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
	</td>";}

if ($y%$norows==$norows-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";
?>
	 <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=$noletters;$y<$noletters+$noletters2;$y++)
{
if ($y%$norows==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$norows][$y/$norows];

echo "<td>$alpha</td>";}


if ($y%$norows==$norows-1) 
{ echo "</tr>";
}

echo "  </tbody>
    </table>
	</body> <br> <h1> Solutions:";
echo $quoteline;
echo "<br>";
echo $quoteline2;
echo "</h1>";
	 ?>

	

	