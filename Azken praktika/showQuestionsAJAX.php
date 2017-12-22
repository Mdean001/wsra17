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


$galderak = $connection->query("SELECT * from questions");

echo '<table border=1> <tr> <th> Enuntziatua </th> <th> Zailtasuna </th> <th> Gaia </th> </tr>'; 

while ( $galdera = $galderak->fetch_object()) {
		echo '<tr> <td> '.$galdera->Galdera.' </td> <td> '.$galdera->Zailtasuna.' </td> <td> '.$galdera->GaiArloa.' </td> </tr>';
}	
echo '</table>';
$galderak->close();
$connection->close();


?> 