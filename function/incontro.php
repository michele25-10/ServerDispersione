<?php
function getArchieveIncontri()
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/getArchieveIncontri.php';

    $json_data = file_get_contents($url);
    if ($json_data != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'id' => $incontri['id'],
                    'id_corso' => $incontri['id_corso'],
                    'data_inizio' => $incontri['data_inizio'],
                    'note' => $incontri['note'],
                    'aula' => $incontri['aula'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}

function addIncontro($id_corso, $incontro, $id_aula)
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/addIncontro.php';

    $data = array(
        "id_corso" => $id_corso,
        "data_inizio" => $incontro,
        "id_aula" => $id_aula,
    );

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json

    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}

function getIncontriToday()
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/getIncontriToday.php';

    $json_data = file_get_contents($url);
    if (intval($json_data) != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'id' => $incontri['id'],
                    'id_corso' => $incontri['id_corso'],
                    'data_inizio' => $incontri['data_inizio'],
                    'note' => $incontri['note'],
                    'nome' => $incontri['nome'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}

function getIncontriTomorrow()
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/getIncontriTomorrow.php';

    $json_data = file_get_contents($url);
    if (intval($json_data) != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'id' => $incontri['id'],
                    'id_corso' => $incontri['id_corso'],
                    'data_inizio' => $incontri['data_inizio'],
                    'note' => $incontri['note'],
                    'nome' => $incontri['nome'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}

function getIncontriNext15Days()
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/getIncontriNext15Days.php';

    $json_data = file_get_contents($url);
    if (intval($json_data) != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'id' => $incontri['id'],
                    'id_corso' => $incontri['id_corso'],
                    'data_inizio' => $incontri['data_inizio'],
                    'note' => $incontri['note'],
                    'nome' => $incontri['nome'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}

function updateIncontro($data)
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/updateIncontro.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json

    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}

function countIncontro()
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/countIncontro.php';

    $json_data = file_get_contents($url);
    if (intval($json_data) != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'partecipanti' => $incontri['partecipanti'],
                    'data' => $incontri['data'],
                    'nome_corso' => $incontri['nome_corso'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}
function getStudentsIncontro($date)
{
    $url = 'https://dispersione.violamarchesini.it/API/incontro/getStudentIncontro.php?data=' . $date;

    $json_data = file_get_contents($url);
    if (intval($json_data) != -1) {
        $decode_data = json_decode($json_data, $assoc = true);
        $list_data = $decode_data;
        $inc_arr = array();
        if (!empty($list_data)) {
            foreach ($list_data as $incontri) {
                $incontri_record = array(
                    'nome' => $incontri['nome'],
                    'cognome' => $incontri['cognome'],
                    'menu' => $incontri['menu'],
                );
                array_push($inc_arr, $incontri_record);
            }
            return $inc_arr;
        }
    } else {
        return -1;
    }
}
