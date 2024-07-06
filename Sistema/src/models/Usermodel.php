<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';

class Usermodel
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Salva o usuário no banco de dados.
     *
     * @return bool 
     */
    public function save(): bool
    {
        $nome = $this->user->getNome();
        $senha = $this->user->getSenha();

        try {
            $conn = Database::getConn(); 

            $stmt = $conn->prepare('INSERT INTO USER (Nome, Senha) VALUES (:nome, :senha)');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log("Erro ao salvar usuário: " . $e->getMessage());
            return false; 
        } finally {
            $conn = null;
        }
    }
}
