<?php
function getArchieveMenu()
{
    $url = 'https://dispersione.violamarchesini.it/API/menu/getArchieveMenu.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $al_data = $decode_data;
        $al_arr = array();
        if (!empty($al_data)) {
            foreach ($al_data as $al) {
                $al_record = array(
                    'id' => $al['id'],
                    'tipologia' => $al['tipologia'],
                    'descrizione' => $al['descrizione'],
                );
                array_push($al_arr, $al_record);
            }
            return $al_arr;
        }
    } else {
        return -1;
    }
}
