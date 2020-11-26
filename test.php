<?php namespace readingTest;

$rindas;// = array("a", "b", "c");

function readRindas($fileName){
	global $rindas;
	$rindas = file($fileName, FILE_IGNORE_NEW_LINES);
}

function writeRindas(){
	global $rindas;
	echo "rinda1: " . $rindas[0] . "<br />";
	echo "rinda2: " . $rindas[1] . "<br />";
	echo "rinda3: " . $rindas[2] . "<br />";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>failu tests</title>

</head>
<body>

<h1>failu tests</h1>



<h2>viena faila lasīšana pa rindām</h2>

<p><?php

use readingTest;
readingTest\readRindas("readable.txt");
readingTest\writeRindas();

?></p>


<h2>sadalīta otrā rinda</h2>

<p><?php

$rinda2 = $rindas[1];
$separator = " : ";
$elementi = explode($separator, $rinda2);

for ($i = 0; $i < count($elementi); $i++){
	echo $i . ". elements : " . $elementi[$i] . "<br />";
}

?></p>


<h2>faila rakstīšana</h2>

<p><?php

$writableContents;
manipulateContents("writable.txt");

function manipulateContents($fileName){
	
	readRindas($fileName);
	echo "sākumā" . "<br />";
	global $rindas;
	splitContents($rindas, FALSE, NULL);
	echo "<br />";
	
	echo "beigās" . "<br />";
	global $writableContents;
	splitContents($rindas, TRUE, $writableContents);
	writeFile($fileName);
}

function splitContents($array, $manipulate, $array2){
	
	$separator  = " : ";
	
	for ($i = 0; $i < count($array); $i++){
		
		$splitLine = explode($separator, $array[$i]);
		$parametrs = $splitLine[0];
		$vertiba = $splitLine[1];
		
		if ($manipulate == TRUE){
			$vertiba++;
			$newLine = $parametrs . $separator . $vertiba . "\n";
			
			global $writableContents;
			$writableContents .= $newLine;
		}
		
		echo "parametrs : " . $parametrs . " , vērtība : " . $vertiba . "<br />";
	}
}

function writeFile($fileName){
	global $writableContents;
	file_put_contents($fileName, $writableContents);
}

?></p>

<button onclick = "pageRefresh()">Refresh</button>

<script>
function pageRefresh(){
	location.reload();
	return false;
}
</script>

</body>

</html>