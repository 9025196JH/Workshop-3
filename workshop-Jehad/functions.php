<?php
// Auteur: Bashar & Jehad
// Functie: Hoofdbestand voor alle database functies
include_once "config.php";

function connectDb()
{
    try {
        $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
}

function getData($table)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}

// --- JEHAD COMPATIBILITY FUNCTIONS (Om errors te voorkomen) ---

function crudMain()
{
    echo "<h1>Gebruikers beheren</h1>";
    echo "<a href='insert.php'>Nieuwe gebruiker toevoegen</a><br><br>";
    $result = getData(CRUD_TABLE);
    if (!empty($result)) {
        printCrudTabel($result);
    } else {
        echo "Geen gebruikers gevonden.";
    }
}

function printCrudTabel($result)
{
    echo "<table class='admin-table'><tr>";
    foreach (array_keys($result[0]) as $header) echo "<th>$header</th>";
    echo "<th colspan='2'>Actie</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($row as $cell) echo "<td>" . htmlspecialchars($cell) . "</td>";
        $id = isset($row['inloggen_id']) ? $row['inloggen_id'] : 0;
        echo "<td><a href='update.php?id=$id'>Wijzig</a></td>";
        echo "<td><a href='delete.php?id=$id' onclick='return confirm(\"Zeker weten?\")'>Verwijder</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

// --- BASHAR'S PRODUCTEN FUNCTIES ---

function getProduct($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM " . TABEL_PRODUCTEN . " WHERE product_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertProduct($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_PRODUCTEN . " (naam, categorie, prijs, foto, voorraad) VALUES (:naam, :categorie, :prijs, :foto, :voorraad)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':naam' => $post['naam'], ':categorie' => $post['categorie'], ':prijs' => $post['prijs'], ':foto' => $post['foto'], ':voorraad' => $post['voorraad']]);
}

function updateProduct($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_PRODUCTEN . " SET naam=:naam, categorie=:categorie, prijs=:prijs, foto=:foto, voorraad=:voorraad WHERE product_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':naam' => $post['naam'], ':categorie' => $post['categorie'], ':prijs' => $post['prijs'], ':foto' => $post['foto'], ':voorraad' => $post['voorraad'], ':id' => $post['product_id']]);
}

function deleteProduct($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM " . TABEL_PRODUCTEN . " WHERE product_id = :id");
    return $stmt->execute([':id' => $id]);
}

// --- BASHAR'S KLACHTEN FUNCTIES ---

function getKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM " . TABEL_KLACHTEN . " WHERE klacht_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertKlacht($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_KLACHTEN . " (product_id, naam, email, beschrijving, datum) VALUES (:product_id, :naam, :email, :beschrijving, CURDATE())";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':product_id' => $post['product_id'], ':naam' => $post['naam'], ':email' => $post['email'], ':beschrijving' => $post['beschrijving']]);
}

function updateKlacht($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_KLACHTEN . " SET product_id=:product_id, naam=:naam, email=:email, beschrijving=:beschrijving, admin_antwoord=:admin_antwoord, datum=CURDATE() WHERE klacht_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':product_id' => $post['product_id'], ':naam' => $post['naam'], ':email' => $post['email'], ':beschrijving' => $post['beschrijving'], ':admin_antwoord' => $post['admin_antwoord'], ':id' => $post['klacht_id']]);
}

function deleteKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM " . TABEL_KLACHTEN . " WHERE klacht_id = :id");
    return $stmt->execute([':id' => $id]);
}

// --- BASHAR'S REVIEWS FUNCTIES ---

function getReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM " . TABEL_REVIEWS . " WHERE review_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertReview($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_REVIEWS . " (product_id, naam, beoordeling, opmerking, datum) VALUES (:product_id, :naam, :beoordeling, :opmerking, CURDATE())";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':product_id' => $post['product_id'], ':naam' => $post['naam'], ':beoordeling' => $post['beoordeling'], ':opmerking' => $post['opmerking']]);
}

function updateReview($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_REVIEWS . " SET naam=:naam, beoordeling=:beoordeling, opmerking=:opmerking, admin_antwoord=:admin_antwoord, datum=CURDATE() WHERE review_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([':naam' => $post['naam'], ':beoordeling' => $post['beoordeling'], ':opmerking' => $post['opmerking'], ':admin_antwoord' => $post['admin_antwoord'], ':id' => $post['review_id']]);
}

function deleteReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM " . TABEL_REVIEWS . " WHERE review_id = :id");
    return $stmt->execute([':id' => $id]);
}

// --- BASHAR'S UTILS ---

function searchProducten($q, $cat)
{
    $conn = connectDb();
    $sql = "SELECT * FROM " . TABEL_PRODUCTEN . " WHERE (naam LIKE :q OR categorie LIKE :q)";
    if ($cat != "") {
        $sql .= " AND categorie = :cat";
    }
    $stmt = $conn->prepare($sql);
    $params = [':q' => "%$q%"];
    if ($cat != "") {
        $params[':cat'] = $cat;
    }
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function printTabel($result, $id_kolom, $edit_url, $delete_url, $hide = [])
{
    if (empty($result)) {
        echo "Geen gegevens gevonden.";
        return;
    }
    $rating_labels = [1 => '1 - Slecht', 2 => '2 - Matig', 3 => '3 - Goed', 4 => '4 - Zeer goed', 5 => '5 - Uitstekend'];
    echo "<table class='admin-table'><tr>";
    foreach (array_keys($result[0]) as $h) if (!in_array($h, $hide)) echo "<th>$h</th>";
    echo "<th>Acties</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($row as $k => $v) {
            if (!in_array($k, $hide)) {
                if ($k == 'beoordeling' && isset($rating_labels[$v])) echo "<td>" . $rating_labels[$v] . "</td>";
                else echo "<td>" . htmlspecialchars($v) . "</td>";
            }
        }
        echo "<td><a href='$edit_url?id=" . $row[$id_kolom] . "'>Wijzig</a> | <a href='$delete_url?id=" . $row[$id_kolom] . "' onclick='return confirm(\"Zeker weten?\")'>Verwijder</a></td></tr>";
    }
    echo "</table>";
}
