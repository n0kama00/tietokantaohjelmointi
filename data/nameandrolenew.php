<?php
    // Muodosta tietokantayhteys
    require_once('../database.php'); // Ota db.php-tiedosto käyttöön tässä tiedostossa
    // Lue region get-parametri muuttujaan
    $role = $_GET['role'];
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = 'SELECT role_, name_ FROM `had_role` INNER JOIN names_ 
    ON had_role.name_id=names_.name_id WHERE role_ LIMIT 10;
    ';
    // Tarkistukset yms
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    // Tulosta otsikko
    $html = '<h1>Name and role ' . $role . '</h1>';
    // Avaa ul-elementti
    $html .= '<ul>';
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<li>' . $row['role_'] . $row['name_'] . '</li>';
    }
    $html .= '</ul>';
    echo $html;