<?php $page_title = ' Quote Drop'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	include ("telugu_parser.php");
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
error_reporting(0);
include_once 'db_credentials.php'; 

  $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";
$flagged=true;
$spaces=array();
$touched=isset($_POST['ident']);
if (!$touched) {
	echo 'You need to select an entry. Go back and try again. <br>';
	
	?>
		  <button><a class="btn btn-sm" href="list.php">Go back</a></button>
	<?php
} else {     $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    

	
}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
  

	
	
	
	
	
}	$norows = 16; //later i'll update this to take from preferences
  echo '<h2 id="title">Float Quote</h2><br>';

	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	while ($row2 =mysqli_fetch_array($result2))
	{
		$norows=$row2["value"];
		$lang=$row2["Language"];
	}
	
	if  (strcmp($lang, "English")==0){
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];


	$noletters=strlen($quoteline);
	if (($noletters%$norows) !=0)
	{ 

       $fodder=($norows-($noletters%$norows));
		$nohope=$noletters;
		$noletters=$noletters+$fodder;
	}
	$sample=array();
	$wheeloffortune =array_fill(0,$norows,$sample);
	

	for ($x = 0;$x <= $noletters;$x++)
	{
		
	$tested =substr($quoteline,$x,1);
	
if (ctype_alnum($tested) &&$x<$nohope)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	}else { $t= $x%$norows;
	
		array_push($spaces,$x);
	}
	}
	}


for ($r=0;$r<$norows;$r++)
{
	shuffle($wheeloffortune[$r]);
}






	
	}
	
	


else {
    echo "0 results";
	$flagged=false;
}
	}else {
		if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	//makes an array from the line
	$arrayfod=parsetoCodePoints($quoteline);
	$noletters=count($arrayfod);
	if (($noletters%$norows) !=0)
	{ 

       $fodder=($norows-($noletters%$norows));
	   $trash=array(" ");
	for ($arrayfod2=0;$arrayfod2<$fodder+1;$arrayfod2++)
	{array_push($arrayfod, $trash);
	}
	
		$noletters=$noletters+$fodder;
	}
	
	$sample=array();
	$wheeloffortune =array_fill(0,$norows,$sample);
	

	for ($x = 0;$x <= $noletters;$x++)
	{
		
	$tested =parseToCharacter($arrayfod[$x]);
	
if (ctype_space($tested)==false && ctype_punct($tested)==false)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$norows;
		//array_push($wheeloffortune[$t],"-");
		array_push($spaces,$x);
	}
	}
	}


for ($r=0;$r<$norows;$r++)
{
	shuffle($wheeloffortune[$r]);
}




}

else {
    echo "0 results";
	$flagged=false;
}
	}	if ($flagged==true)
	{
		
		
		
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
if (in_array($y,$spaces)==false){
echo "<td></td>";} else {
	echo "<td style=\"background-color:#000000;\"> 
	
	</td>";}

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

echo "<td>.$alpha.</td>";

if ($y%$norows==$norows-1) 
{ echo "</tr>";
}
}
	}
		
echo "  </tbody>
    </table>
	</body> <br> <h1> Solution:";
echo $quoteline;
echo "</h1>";
	 ?>





</div>