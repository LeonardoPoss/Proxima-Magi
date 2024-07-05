<?php

// Inclui os arquivos necessários
require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../PHP/MODELS/User.php';
require_once __DIR__ . '/../../PHP/MODELS/Usermodel.php'; // Corrigi o nome do arquivo Usermodel.php

// Recebe os dados JSON da requisição POST
$data = json_decode(file_get_contents("php://input"));

// Verifica se os dados necessários foram recebidos
if (!empty($data->nome) && !empty($data->senha)) {
    // Cria um novo objeto User com os dados recebidos
    $user = new User($data->nome, $data->senha);

    // Cria um novo objeto Usermodel passando o objeto User criado
    $userModel = new Usermodel($user);

    // Tenta salvar o usuário no banco de dados
    if ($userModel->save()) {
        http_response_code(201); // Código 201 para criação bem-sucedida
        echo json_encode(array("message" => "Usuário cadastrado com sucesso."));
    } else {
        http_response_code(503); // Código 503 para serviço indisponível
        echo json_encode(array("message" => "Não foi possível cadastrar o usuário."));
    }
} else {
    http_response_code(400); // Código 400 para requisição inválida
    echo json_encode(array("message" => "Dados incompletos."));
}

?>
