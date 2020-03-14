<?php

$i = 1000;
$j = 999;

$x = $i-$j;
echo "x =".$x."<br>";

$k = 15;

if($x>=$k){
	echo "HELLO";
}else{
	$y= $k-$x;
	echo "y =".$y."<br>";
	$z=$k-$y;
	echo "z =".$z."<br>";
}


?>