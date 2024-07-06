<?php

require_once __DIR__ . '/../../DB/Database.php';
require_once __DIR__ . '/../../PHP/MODELS/User.php';

class Usermodel
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $nome = $this->user->getNome();
        $senha = $this->user->getSenha();

        try {
            $conn = Database::getConn(); // Obtém a conexão com o banco de dados

            // Prepara a query SQL para inserir um novo usuário
            $stmt = $conn->prepare('INSERT INTO USER (Nome, Senha) VALUES (:nome, :senha)');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);

            // Executa a query
            if ($stmt->execute()) {
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } else {
                return false; // Retorna falso se houver algum erro na execução
            }
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar de alguma forma
            echo "Erro ao salvar usuário: " . $e->getMessage();
            return false; // Retorna falso em caso de exceção
        }
    }
}

?>
