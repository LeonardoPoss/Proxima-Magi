<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserModel.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->nome) && !empty($data->senha)) {
    $user = new User($data->nome, $data->senha);
    $userModel = new Usermodel($user);
    if ($userModel->save()) {
        http_response_code(201); 
        echo json_encode(array("message" => "Usuário cadastrado com sucesso."));
    } else {
        http_response_code(503); 
        echo json_encode(array("message" => "Não foi possível cadastrar o usuário."));
    }
} else {
    http_response_code(400); 
    echo json_encode(array("message" => "Dados incompletos."));
}
