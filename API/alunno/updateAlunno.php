<?php
require("../../COMMON/connect.php");
require("../../MODEL/alunno.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id) || empty($data->nome) || empty($data->cognome) || empty($data->SIDI) || empty($data->telefono) || empty($data->menu) || empty($data->rischio)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();

$league = new Alunno($conn);

$query = $league->updateAlunno($data->id, $data->nome, $data->cognome, $data->SIDI, $data->telefono, $data->menu , $data->rischio);
$result = $conn->query($query);
var_dump($result);
if ($result != false) {
    http_response_code(200);
    echo json_encode(["message" => true]);
} else {
    http_response_code(401);
    echo json_encode(["message" => false]);
}

die();
