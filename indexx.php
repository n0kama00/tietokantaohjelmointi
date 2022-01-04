<?php
    require_once('functions.php');
    // Hakukriteerit
    $html = "<h2>Criteria</h2>";
    $html .= '<form action="GET">';
    // pudotusvalikot
    $html .= createNameAndRoleDropDown();
    $html .= createRatingDropDown();
    // Looppaa läpi tiedostot datasets-hakemistosta
    $path = 'data';
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            $html .= '<div><input type="submit" value="' . basename($file, ".php") . '" formaction="' . $path . "/" . $file . '"></div>';
        }
        closedir($handle);
    }
    $html .= '</form>';
    // Luo painike, joka lähettää lomakkeen käsiteltävänä olevalle tiedostolle
    echo $html;