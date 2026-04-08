
<?php
// auteur: Jehad
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb(){
    $servername = SERVERNAME;
    $username   = USERNAME;
    $password   = PASSWORD;
    $dbname     = DATABASE;   
       
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function crudMain(){

    echo "
    <h1>Leveranciers</h1>
    <a href='insert.php'>Nieuwe leverancier toevoegen</a>
    <br><br>";

    $result = getData(CRUD_TABLE);

    if (empty($result)) {
        echo "<p>Geen leveranciers gevonden.</p>";
        return;
    }

    printCrudTabel($result);
}


function getData($table){
    $conn = connectDb();
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}


function getRecord($id){
    $conn = connectDb();

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE leverancier_id = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id' => $id]);

    return $query->fetch();
}


function printCrudTabel($result){
    
    $table = "<table border='1'>";

    // header
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";
    }
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    // content
    foreach ($result as $row) {

        $table .= "<tr>";

        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }

        $id = $row['leverancier_id'];

        $table .= "<td>
            <a href='update.php?id=$id'>Wzg</a>
        </td>";

        $table .= "<td>
            <a href='delete.php?id=$id'>Verwijder</a>
        </td>";

        $table .= "</tr>";
    }

    $table .= "</table>";

    echo $table;
}


function updateRecord($row){

    $conn = connectDb();

    $sql = "UPDATE " . CRUD_TABLE . "
            SET 
                naam = :naam,
                bedrijfsnaam = :bedrijfsnaam,
                telefoonnummer = :telefoonnummer
            WHERE leverancier_id = :leverancier_id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'            => $row['naam'],
        ':bedrijfsnaam'    => $row['bedrijfsnaam'],
        ':telefoonnummer'  => $row['telefoonnummer'],
        ':leverancier_id'  => $row['leverancier_id']
    ]);

    return ($stmt->rowCount() >= 0);
}


function insertRecord($post){
    $conn = connectDb();

    $sql = "INSERT INTO " . CRUD_TABLE . 
           " (naam, bedrijfsnaam, telefoonnummer)
            VALUES (:naam, :bedrijfsnaam, :telefoonnummer)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'            => $post['naam'],
        ':bedrijfsnaam'    => $post['bedrijfsnaam'],
        ':telefoonnummer'  => $post['telefoonnummer']
    ]);

    return ($stmt->rowCount() == 1);
}


function deleteRecord($id){

    $conn = connectDb();
    
    $sql = "DELETE FROM " . CRUD_TABLE . " 
            WHERE leverancier_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([':id' => $id]);

    return ($stmt->rowCount() == 1);
}

?>
