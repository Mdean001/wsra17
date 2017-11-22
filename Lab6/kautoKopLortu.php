<?php
$xml = simplexml_load_file('counter.xml');

$erabilKop = $xml->children()->itemBody->p;

echo " $erabilKop ";
?>