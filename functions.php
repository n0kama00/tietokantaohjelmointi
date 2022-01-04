<?php

    function createNameAndRoleDropDown() {
        // Muodosta tietokantayhteys
        require_once('db.php'); // Ota db.php-tiedosto käyttöön tässä tiedostossa
        $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
        // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
        $sql = 'SELECT role_, name_ FROM `had_role` INNER JOIN names_ 
        ON had_role.name_id=names_.name_id WHERE role_ LIMIT 10;
        ';
       // Aja kysely kantaan
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="role">';
        // Looppaa tietokannasta saadut rivit läpi
        foreach($rows as $row) {
            // Tulosta jokaiselle riville li-elementti
            $html .= '<option>' . $row['role'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    function createRatingDropDown() {
        // Muodosta tietokantayhteys
        require_once('db.php'); // Ota db.php-tiedosto käyttöön tässä tiedostossa
        $conn = createDbConnection(); // Kutsutaan db.php-tiedostossa olevaa createDbConnection()-funktiota, joka avaa tietokantayhteden
        // Muodosta SQL-lause muuttujaan. Tässä vaiheessa tätä ei vielä ajeta kantaan.
        $sql = 'SELECT primary_title, title_ratings.average_rating 
        FROM titles INNER JOIN title_ratings ON titles.title_id=title_ratings.title_id 
        LIMIT 40;
        ';
       // Aja kysely kantaan
        $prepare = $conn->prepare($sql);
        $prepare->execute();
        // Tallenna vastaus muuttujaan
        $rows = $prepare->fetchAll();
        $html = '<select name="rating">';
        // Looppaa tietokannasta saadut rivit läpi
        foreach($rows as $row) {
            // Tulosta jokaiselle riville li-elementti
            $html .= '<option>' . $row['rating'] . '</option>';
        }
        $html .= '</select>';
        return $html;
    }