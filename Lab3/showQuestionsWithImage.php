 <?php

include 'konfigurazioa.php';

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Konekxioak kale egin: " . $conn->connect_error);
}
//echo "Zuzen konektatuta";
echo "<br/>";

$eposta = $_GET['eposta'];

$galderak = $connection->query("SELECT * from questions");

$connection1 = new mysqli($servername, $username, $password, $dbname);
$galderak1 = $connection1->query("SELECT * from users where Eposta= '$_GET[eposta]' ");
while ( $galdera1 = $galderak1->fetch_object()) {
	echo '<p align="right">Zure perfileko irudia </p>';
	echo '<img src="data:image/jpeg;base64,'.base64_encode($galdera1->Irudia).'" width="200" heigth="150" align="right" />';
}
$galderak1->close();
$connection1->close();

echo '<table border=1> <tr> <th> ID </th> <th> Eposta </th> <th> Galdera </th> <th> Erantzun zuzena </th>'; 
echo '<th> Erantzun okerra 1 </th> <th> Erantzun okerra 2 </th> <th> Erantzun okerra 3 </th> <th> Zailtasuna </th> <th> Gai-arloa </th> <th> Irudia</th> </tr>';

while ( $galdera = $galderak->fetch_object()) {
		echo '<tr> <td> '.$galdera->ID.' </td> <td> '.$galdera->Eposta.' </td> <td> '.$galdera->Galdera.' </td> <td> '.$galdera->ErantzunZuzena.'</td>';
        echo '<td> '.$galdera->ErantzunOkerra1.' </td> <td> '.$galdera->ErantzunOkerra2.' </td> <td> '.$galdera->ErantzunOkerra3.' </td>';
		echo '<td> '.$galdera->Zailtasuna.' </td> <td> '.$galdera->GaiArloa.' </td>';
		echo '<td> '.'<img src="data:image/jpeg;base64,'.base64_encode($galdera->Irudia).'" width="200" heigth="150" />'.' </td> </tr>';
}	
echo '</table>';
echo "<a href=layoutR.php?eposta=$eposta> Itzuli orri nagusira </a>";
$galderak->close();
$connection->close();


?>