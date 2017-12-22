 <?php

include 'konfigurazioa.php';

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Konekxioak kale egin: " . $conn->connect_error);
}
//echo "Zuzen konektatuta";

$galderak = $connection->query("SELECT * from questions");

echo '<table border=1 bgcolor="white"> <tr> <th> ID </th> <th> Eposta </th> <th> Galdera </th> <th> Erantzun zuzena </th>'; 
echo '<th> Erantzun okerra 1 </th> <th> Erantzun okerra 2 </th> <th> Erantzun okerra 3 </th> <th> Zailtasuna </th> <th> Gai-arloa </th> </tr>';

while ( $galdera = $galderak->fetch_object()) {
		echo '<tr> <td> '.$galdera->ID.' </td> <td> '.$galdera->Eposta.' </td> <td> '.$galdera->Galdera.' </td> <td> '.$galdera->ErantzunZuzena.'</td>';
        echo '<td> '.$galdera->ErantzunOkerra1.' </td> <td> '.$galdera->ErantzunOkerra2.' </td> <td> '.$galdera->ErantzunOkerra3.' </td>';
		echo '<td> '.$galdera->Zailtasuna.' </td> <td> '.$galdera->GaiArloa.' </td> </tr>';
}	
echo '</table>';
$galderak->close();
$connection->close();


?> 