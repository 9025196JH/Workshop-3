<?php
// auteur: Jehad
// functie: algemene functies tbv hergebruik

include_once "con.php";

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

    $txt = "
    <h1>Gebruikers</h1>
    <a href='insert.php'>Nieuwe gebruiker toevoegen</a>
    <br><br>";
    echo $txt;

    $result = getData(CRUD_TABLE);

    
    if (empty($result)) {
        echo "<p>Geen gebruikers gevonden.</p>";
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

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE inloggen_id = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id' => $id]);

    return $query->fetch();
 }

 
 function printCrudTabel($result){
    
    $table = "<table>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }

    // Extra kolommen voor actie-knoppen
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</tr>";

    // Print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";

        // Print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }

        // ✅ juiste ID gebruiken
        $id = $row['inloggen_id'];
        
        // Wijzig knopje
        $table .= "<td>
            <form method='post' action='update.php?id=$id'>       
                <button>Wzg</button>     
            </form>
        </td>";

        // Delete knopje
        $table .= "<td>
            <form method='post' action='delete.php?id=$id'>       
                <button>Verwijder</button>     
            </form>
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
                bedrijfsnaam = :email,
                telefoonnummer = :wachtwoord
            WHERE leverancier_id = :leverancier_id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'        => $row['naam'],
        ':bedrijfsnaam'       => $row['bedrijfsnaam'],
        ':telefoonnummer'  => $row['telefoonnummer'],
        ':leverancier_id' => $row['leverancier_id']
    ]);

    return ($stmt->rowCount() == 1);
 }

 
 function insertRecord($post){
    $conn = connectDb();

    $sql = "INSERT INTO gebruikers 
            (naam, bedrijfsnaam, telefoonnummer)
            VALUES (:naam, :bedrijfsnaam, :telefoonnummer)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':naam'        => $post['naam'],
        ':bedrijsnaam'       => $post['bedrijsnaam'],
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