<?php
$eposta = $_GET['eposta'];

echo '<h2> XML orriko galderak hauek dira: </h2>';
echo '<br/>';

echo '<table border=1> <tr> <th> Enuntziatua </th> <th> Zailtasuna </th> <th> Gaia </th> </tr>';

$xml = simplexml_load_file('questions.xml');
foreach($xml->children() as $galderaXML){
	
	$zailtasunaXML = $galderaXML['complexity'];
	$gaiaXML = $galderaXML['subject'];
	
	$enuntziatuaXML = $galderaXML->itemBody->p;
	
	echo '<tr> <td> '.$enuntziatuaXML.' </td> <td> '.$zailtasunaXML.' </td> <td> '.$gaiaXML.' </td> </tr>';
}
echo '</table>';
echo '<br/>';
echo "<a href=layoutR.php?eposta=$eposta> Itzuli orri nagusira </a>";
?>