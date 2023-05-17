<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informazione Corso</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div id="pageloader">
        <div class="spinner-border text-primary" id="spinner" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
    <?php
    if (!empty($_POST['submit'])) {
        $stringa = $_POST['submit'];
        $stringa_esplosa = explode(" ", $stringa);
        $id_corso = $stringa_esplosa[0];
        $nome_corso = explode("_", $stringa_esplosa[1]);
        $tipologia = $nome_corso[1];

        include_once dirname(__FILE__) . '/../function/iscrizione.php';

        switch ($tipologia) {
            case 'A':
                if (!empty($_POST['alunno1'])) {
                    $res = addAlunnoToCorso($id_corso, $_POST["alunno1"]);
                }
                break;
            case 'B':
                if (!empty($_POST['alunno1']) && !empty($_POST['alunno2']) && !empty($_POST['alunno3']) && !empty($_POST['alunno4']) && !empty($_POST['alunno5']) && !empty($_POST['alunno6'])) {
                    for ($x = 1; $x < 7; $x++) {
                        $res = addAlunnoToCorso($id_corso, $_POST["alunno" . $x]);
                    }
                }
                break;
            case 'C':
                if (!empty($_POST['alunno1']) && !empty($_POST['alunno2']) && !empty($_POST['alunno3']) && !empty($_POST['alunno4']) && !empty($_POST['alunno5']) && !empty($_POST['alunno6']) && !empty($_POST['alunno7']) && !empty($_POST['alunno8']) && !empty($_POST['alunno9'])) {
                    for ($x = 1; $x < 10; $x++) {
                        $res = addAlunnoToCorso($id_corso, $_POST["alunno" . $x]);
                    }
                }
                break;
        }

        echo '<script>window . location . replace(
            "https://dispersione.violamarchesini.it/");</script>';
    }
    ?>
</body>
<style>
#pageloader {
    background: rgba(255, 255, 255, 0.8);
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 9999;
}

#spinner {
    left: 50%;
    margin-left: -32px;
    margin-top: -32px;
    position: absolute;
    top: 50%;
}
</style>

</html>