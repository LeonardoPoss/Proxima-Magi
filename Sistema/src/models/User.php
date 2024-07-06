<?php

class User
{
    private string $nome;
    private string $senha;

    public function __construct(string $nome, string $senha)
    {
        if (strlen($nome) < 3) {
            throw new InvalidArgumentException("O nome deve ter pelo menos 3 caracteres.");
        }
        if (strlen($senha) < 6) {
            throw new InvalidArgumentException("A senha deve ter pelo menos 6 caracteres.");
        }
        $this->nome = $nome;
        $this->senha = password_hash($senha, PASSWORD_BCRYPT); 
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }
}
