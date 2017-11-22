<?php
//echo '<h2> XML orriko galderak hauek dira: </h2>';

echo '<table border=1 bgcolor="white"> <tr> <th> Enuntziatua </th> <th> Zailtasuna </th> <th> Gaia </th> </tr>';

$xml = simplexml_load_file('questions.xml');
foreach($xml->children() as $galderaXML){
	
	$zailtasunaXML = $galderaXML['complexity'];
	$gaiaXML = $galderaXML['subject'];
	
	$enuntziatuaXML = $galderaXML->itemBody->p;
	
	echo '<tr> <td> '.$enuntziatuaXML.' </td> <td> '.$zailtasunaXML.' </td> <td> '.$gaiaXML.' </td> </tr>';
}
echo '</table>';
echo '<br/>';
?>