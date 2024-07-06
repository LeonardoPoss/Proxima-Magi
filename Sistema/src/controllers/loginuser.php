<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';

// Recebe os dados JSON da requisição POST
$data = json_decode(file_get_contents("php://input"));

// Verifica se os dados necessários foram recebidos
if (!empty($data->nome) && !empty($data->senha)) {
    $nome = $data->nome;
    $senha = $data->senha;

    try {
        $conn = Database::getConn(); // Obtém a conexão com o banco de dados

        // Prepara a query SQL para buscar o usuário pelo nome
        $stmt = $conn->prepare('SELECT * FROM USER WHERE Nome = :nome');
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se encontrou um usuário e se a senha confere
        if ($user && password_verify($senha, $user['Senha'])) {
            // Login bem-sucedido
            http_response_code(200);
            echo json_encode(array("success" => true, "message" => "Login bem-sucedido."));
        } else {
            // Nome de usuário ou senha incorretos
            http_response_code(401);
            echo json_encode(array("success" => false, "message" => "Nome de usuário ou senha incorretos."));
        }
    } catch (PDOException $e) {
        // Em caso de erro, você pode tratar de alguma forma
        http_response_code(500);
        echo json_encode(array("success" => false, "message" => "Erro ao processar a solicitação."));
    }
} else {
    // Dados incompletos
    http_response_code(400);
    echo json_encode(array("success" => false, "message" => "Dados incompletos."));
}
