<script>
if (sessionStorage.getItem('user_id') == undefined) {
    window.location.replace('https://dispersione.violamarchesini.it/');
}
</script>

<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diario | Archivio Alunni</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<body>
    <?php require_once(__DIR__ . '/navbar.php');
    include_once dirname(__FILE__) . '/../function/alunno.php';
    include_once dirname(__FILE__) . '/../function/menu.php';

    $list = getArchieveAlunni();
    $menu = getArchieveMenu();
    ?>


    <div class="container mt-5">
        <h2>Archivio degli alunni:</h2>
        <div style="overflow: auto; overflow-y: hidden">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>SIDI</th>
                        <th>Telefono</th>
                        <th>Menù</th>
                        <th>Opzioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $row) : ?>
                    <tr>
                        <td><?php echo ($row['nome']) ?></td>
                        <td><?php echo ($row['cognome']) ?></td>
                        <td><?php echo ($row['SIDI']) ?></td>
                        <td><?php echo ($row['telefono']) ?></td>
                        <td><?php echo $row['menu']; ?></td>
                        <td>
                            <button id="edit" class="btn btn-primary me-1 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                onclick="onClick('<?php echo $row['CF'] ?>')">Edit</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>SIDI</th>
                        <th>Telefono</th>
                        <th>Menù</th>
                        <th>Opzioni</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class=" modal fade" id="exampleModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Modifica alunno</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cognome:</label>
                            <input type="text" id="cognome" name="cognome" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SIDI:</label>
                            <input type="text" id="SIDI" name="SIDI" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono:</label>
                            <input type="text" id="telefono" name="telefono" class="form-control"></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo di menù:</label>
                            <select id="menu" class="form-select" aria-label="Default select example" name="menu"
                                required>
                                <option selected disabled>Tipo di menù:</option>
                                <option value="Classico">Classico</option>
                                <?php foreach ($menu as $row) : ?>
                                <option value="<?php echo $row['id'] ?>">
                                    <?php echo ($row['tipologia']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="id" name="id">Invia</button>
                </div>
                </form>
            </div>
        </div>

        <script>
        function onClick(CF) {
            let endpoint = 'https://dispersione.violamarchesini.it/API/alunno/getAlunnoByCF.php?CF=' + CF
            $.get(endpoint, function(data, status) {
                $('#nome').val(data[0][
                    'nome'
                ]);
                $('#cognome').val(data[0][
                    'cognome'
                ]);
                $('#SIDI').val(data[0][
                    'SIDI'
                ]);
                $('#telefono').val(data[0][
                    'telefono'
                ]);
                $('#id').val(data[0][
                    'CF'
                ]);
                $('#menu option[value=' + data[0]['menu'] + ']').prop('selected', true);
            })
        }

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function() {
                var title = $(this).text();
                if (title != "Opzioni") {
                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                }
            });

            // DataTable
            var table = $('#example').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear',
                                function() {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                        });
                },
            });
        });
        </script>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_POST['menu'] == "Classico") {
                $menu = "-1";
            } else {
                $menu = $_POST['menu'];
            }

            $data = array(
                "id" => $_POST["id"],
                "nome" => $_POST['nome'],
                "cognome" => $_POST['cognome'],
                "SIDI" => $_POST['SIDI'],
                "telefono" => $_POST['telefono'],
                "menu" => $menu
            );

            $res = updateAlunno($data);

            if ($res == 1) {
                echo '<script>window . location . replace(
            "https://dispersione.violamarchesini.it/pages/archivioAlunni.php"
            );</script>';
            }
        }
        ?>

        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>