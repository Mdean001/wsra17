<?php
$xml = simplexml_load_file('counter.xml');
$xml->children()->itemBody->p = $xml->children()->itemBody->p - 1;
$xml->asXML('counter.xml');
echo "Saioa itxi duzu. Hurrrengora arte!!<br/>";
echo "<a href=layout.html> Itzuli orri nagusira </a>";
?>