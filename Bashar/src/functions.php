<?php
include_once "config.php";

function connectDb()
{
    $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $conn;
}

function getData($table)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProduct($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM producten WHERE product_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertProduct($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO producten (naam, categorie, prijs, foto, voorraad) VALUES (:naam, :categorie, :prijs, :foto, :voorraad)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':categorie' => $post['categorie'],
        ':prijs' => $post['prijs'],
        ':foto' => $post['foto'], // Nieuw veld
        ':voorraad' => $post['voorraad']
    ]);
}

function updateProduct($post)
{
    $conn = connectDb();
    $sql = "UPDATE producten SET naam=:naam, categorie=:categorie, prijs=:prijs, foto=:foto, voorraad=:voorraad WHERE product_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':categorie' => $post['categorie'],
        ':prijs' => $post['prijs'],
        ':foto' => $post['foto'], // Nieuw veld
        ':voorraad' => $post['voorraad'],
        ':id' => $post['product_id']
    ]);
}

function deleteProduct($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM producten WHERE product_id = :id");
    return $stmt->execute([':id' => $id]);
}

function getKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM klachten WHERE klacht_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertKlacht($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO klachten (product_id, naam, email, beschrijving, datum) 
            VALUES (:product_id, :naam, :email, :beschrijving, CURDATE())";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        ':product_id'   => 7,
        ':naam'         => $post['naam'],
        ':email'        => $post['email'],
        ':beschrijving' => $post['beschrijving']
    ]);
}

function updateKlacht($post)
{
    $conn = connectDb();
    $sql = "UPDATE klachten SET naam=:naam, email=:email, beschrijving=:beschrijving, datum=CURDATE() WHERE klacht_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':email' => $post['email'],
        ':beschrijving' => $post['beschrijving'],
        ':id' => $post['klacht_id']
    ]);
}

function deleteKlacht($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM klachten WHERE klacht_id = :id");
    return $stmt->execute([':id' => $id]);
}

function getReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE review_id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

function insertReview($post)
{
    $conn = connectDb();
    $sql = "INSERT INTO reviews (naam, beoordeling, opmerking, datum) VALUES (:naam, :beoordeling, :opmerking, CURDATE())";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam'         => $post['naam'],
        ':beoordeling'  => $post['beoordeling'],
        ':opmerking'    => $post['opmerking']
    ]);
}

function updateReview($post)
{
    $conn = connectDb();
    $sql = "UPDATE reviews SET naam=:naam, beoordeling=:beoordeling, opmerking=:opmerking WHERE review_id=:id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':naam' => $post['naam'],
        ':beoordeling' => $post['beoordeling'],
        ':opmerking' => $post['opmerking'],
        ':id' => $post['review_id']
    ]);
}

function deleteReview($id)
{
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM reviews WHERE review_id = :id");
    return $stmt->execute([':id' => $id]);
}

function searchProducten($q, $cat)
{
    $conn = connectDb();
    $sql = "SELECT * FROM producten WHERE (naam LIKE :q OR categorie LIKE :q)";
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
        echo "Geen gegevens.";
        return;
    }
    echo "<table class='admin-table'><tr>";
    foreach (array_keys($result[0]) as $h) {
        if (!in_array($h, $hide)) echo "<th>$h</th>";
    }
    echo "<th>Acties</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        foreach ($row as $k => $v) {
            if (!in_array($k, $hide)) echo "<td>$v</td>";
        }
        echo "<td><a href='$edit_url?id=" . $row[$id_kolom] . "'>Wzg</a> | 
              <a href='$delete_url?id=" . $row[$id_kolom] . "' onclick='return confirm(\"Zeker?\")'>Verwijder</a></td></tr>";
    }
    echo "</table>";
}
