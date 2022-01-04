<?php
    // Muodosta tietokantayhteys
    require_once('../database.php'); // Ota db.php-tiedosto käyttöön tässä tiedostossa
    // Lue region get-parametri muuttujaan
    $rating = $_GET['rating'];
    $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
    // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
    $sql = 'SELECT primary_title, title_ratings.average_rating 
    FROM titles INNER JOIN title_ratings 
    ON titles.title_id=title_ratings.title_id LIMIT 40;
    ';
    // Tarkistukset yms
    // Aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    // Tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    // Tulosta otsikko
    $html = '<h1>Title and rating ' . $rating . '</h1>';
    // Avaa ul-elementti
    $html .= '<ul>';
    // Looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
        // Tulosta jokaiselle riville li-elementti
        $html .= '<li>' . $row['primary_title'] . $row[' rating']'</li>';
    }
    $html .= '</ul>';
    echo $html;