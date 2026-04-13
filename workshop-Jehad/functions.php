
<?php
// Auteur: Bashar & Jehad
// Functie: Hoofdbestand voor alle database functies
include_once "config.php";


function connectDb()
{
    try {
        $conn = new PDO(
            "mysql:host=" . SERVERNAME . ";dbname=" . DATABASE,
            USERNAME,
            PASSWORD
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch (PDOException $e) {
        die("Verbinding mislukt: " . $e->getMessage());
    }
}

function getData($table)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}



// Jehad leverancier 
function getLeveren()
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT leverancier_id, naam FROM leveren");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getLeverancier($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "SELECT * FROM " . TABEL_LEVERANCIERS . " WHERE leverancier_id = :id"
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertLeverancier($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_LEVERANCIERS .
           " (naam, bedrijfsnaam, telefoonnummer)
             VALUES (:naam, :bedrijfsnaam, :telefoonnummer)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':bedrijfsnaam' => $post['bedrijfsnaam'],
        ':telefoonnummer' => $post['telefoonnummer']
    ]);
}

function updateLeverancier($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_LEVERANCIERS . "
            SET naam=:naam, bedrijfsnaam=:bedrijfsnaam, telefoonnummer=:telefoonnummer
            WHERE leverancier_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':bedrijfsnaam' => $post['bedrijfsnaam'],
        ':telefoonnummer' => $post['telefoonnummer'],
        ':id' => $post['leverancier_id']
    ]);
}

function deleteLeverancier($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "DELETE FROM " . TABEL_LEVERANCIERS . " WHERE leverancier_id = :id"
    );
    return $stmt->execute([':id' => $id]);
}

/* =======================
   PRODUCTEN
======================= */

// ✅ AANGEPAST: haalt ook leveranciersnaam op
function getProduct($id)
{
    $conn = connectDb();

    $sql = "SELECT p.*, l.naam AS leverancier_naam
            FROM producten p
            LEFT JOIN leveren l
              ON p.leverancier_id = l.leverancier_id
            WHERE p.product_id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}


function insertProduct($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_PRODUCTEN . "
            (naam, categorie, prijs, foto, voorraad, leverancier_id)
            VALUES
            (:naam, :categorie, :prijs, :foto, :voorraad, :leverancier_id)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':categorie' => $post['categorie'],
        ':prijs' => $post['prijs'],
        ':foto' => $post['foto'],
        ':voorraad' => $post['voorraad'],
        ':leverancier_id' => $post['leverancier_id']
    ]);
}

// ✅ AANGEPAST: leverancier_id bijwerken
function updateProduct($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_PRODUCTEN . " SET
                naam=:naam,
                categorie=:categorie,
                prijs=:prijs,
                foto=:foto,
                voorraad=:voorraad,
                leverancier_id=:leverancier_id
            WHERE product_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':categorie' => $post['categorie'],
        ':prijs' => $post['prijs'],
        ':foto' => $post['foto'],
        ':voorraad' => $post['voorraad'],
        ':leverancier_id' => $post['leverancier_id'],
        ':id' => $post['product_id']
    ]);
}

function deleteProduct($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "DELETE FROM " . TABEL_PRODUCTEN . " WHERE product_id = :id"
    );
    return $stmt->execute([':id' => $id]);
}

/* =======================
   KLACHTEN
======================= */
function getKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "SELECT * FROM " . TABEL_KLACHTEN . " WHERE klacht_id = :id"
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertKlacht($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_KLACHTEN .
           " (product_id, naam, email, beschrijving, datum)
             VALUES (:product_id, :naam, :email, :beschrijving, CURDATE())";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':product_id' => $post['product_id'],
        ':naam' => $post['naam'],
        ':email' => $post['email'],
        ':beschrijving' => $post['beschrijving']
    ]);
}

function updateKlacht($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_KLACHTEN . "
            SET product_id=:product_id,
                naam=:naam,
                email=:email,
                beschrijving=:beschrijving,
                admin_antwoord=:admin_antwoord,
                datum=CURDATE()
            WHERE klacht_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':product_id' => $post['product_id'],
        ':naam' => $post['naam'],
        ':email' => $post['email'],
        ':beschrijving' => $post['beschrijving'],
        ':admin_antwoord' => $post['admin_antwoord'],
        ':id' => $post['klacht_id']
    ]);
}

function deleteKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "DELETE FROM " . TABEL_KLACHTEN . " WHERE klacht_id = :id"
    );
    return $stmt->execute([':id' => $id]);
}

/* =======================
   REVIEWS
======================= */
function getReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "SELECT * FROM " . TABEL_REVIEWS . " WHERE review_id = :id"
    );
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertReview($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO " . TABEL_REVIEWS .
           " (product_id, naam, beoordeling, opmerking, datum)
             VALUES (:product_id, :naam, :beoordeling, :opmerking, CURDATE())";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':product_id' => $post['product_id'],
        ':naam' => $post['naam'],
        ':beoordeling' => $post['beoordeling'],
        ':opmerking' => $post['opmerking']
    ]);
}

function updateReview($post)
{
    $conn = connectDb();
    $sql = "UPDATE " . TABEL_REVIEWS . "
            SET naam=:naam,
                beoordeling=:beoordeling,
                opmerking=:opmerking,
                admin_antwoord=:admin_antwoord,
                datum=CURDATE()
            WHERE review_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':beoordeling' => $post['beoordeling'],
        ':opmerking' => $post['opmerking'],
        ':admin_antwoord' => $post['admin_antwoord'],
        ':id' => $post['review_id']
    ]);
}

function deleteReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare(
        "DELETE FROM " . TABEL_REVIEWS . " WHERE review_id = :id"
    );
    return $stmt->execute([':id' => $id]);
}

// Jehad login 
function searchProducten($q, $cat)
{
    $conn = connectDb();
    $sql = "SELECT * FROM " . TABEL_PRODUCTEN . "
            WHERE (naam LIKE :q OR categorie LIKE :q)";
    if ($cat != "") $sql .= " AND categorie = :cat";
    $stmt = $conn->prepare($sql);
    $params = [':q' => "%$q%"];
    if ($cat != "") $params[':cat'] = $cat;
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function checkLogin($email, $wachtwoord)
{
    if ($email === 'test@techzone.nl' && $wachtwoord === 'test123') {
        return ['inloggen_id' => 1, 'naam' => 'Test Gebruiker'];
    }
    return false;
}

function logout()
{
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
}


function printTabel($result, $id_kolom, $edit_url, $delete_url, $hide = [])
{
    if (empty($result)) {
        echo "Geen gegevens gevonden.";
        return;
    }

    echo "<table class='admin-table'><tr>";

    foreach (array_keys($result[0]) as $header) {
        if (!in_array($header, $hide)) {
            echo "<th>$header</th>";
        }
    }
    echo "<th>Acties</th></tr>";

    foreach ($result as $row) {
        echo "<tr>";

        foreach ($row as $key => $value) {
            if (!in_array($key, $hide)) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
        }

        echo "<td>
                <a href='$edit_url?id={$row[$id_kolom]}'>Wijzig</a> |
                <a href='$delete_url?id={$row[$id_kolom]}' onclick='return confirm(\"Zeker weten?\")'>Verwijder</a>
              </td>";

        echo "</tr>";
    }

    echo "</table>";
}

?>