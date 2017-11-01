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

$eposta = $_POST['eposta'];

$galdera = $_POST['galdera'];

$eranZuzen = $_POST['eranZuzen'];

$eranOker1 = $_POST['eranOker1'];

$eranOker2 = $_POST['eranOker2'];

$eranOker3 = $_POST['eranOker3'];

$zailtasun = $_POST['zailtasun'];

$gaia = $_POST['gaia'];

$sql = "INSERT INTO questions(Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, GaiArloa) VALUES ('$eposta','$galdera','$eranZuzen','$eranOker1','$eranOker2','$eranOker3','$zailtasun','$gaia')";

if ($connection->query($sql) === TRUE) {
    echo "Datu-basean galdera zuzen txertatu da <br/>";
	echo "<a href='showQuestions.php'> Ikusi datu-baseko galderak </a><br/>";
	echo "<a href='addQuestion.html'> Beste galdera bat txertatu </a><br/>";
} else {
    //echo "Error: " . $sql . "<br>" . $connection->error;
	echo "Errorea: Galdera datu-basean txertatzea ez da posible izan <br/>";
	echo "<a href='addQuestion.html'> Beste galdera bat txertatu </a><br/>";
	
}

$connection->close();
?> 