<?php

class User
{
    private string $nome;
    private string $senha;

    public function __construct(string $nome, string $senha)
    {
        $this->nome = $nome;
        $this->senha = $senha;
    }

    // Métodos para definir o nome e a senha
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    // Métodos para obter o nome e a senha
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    // Método para validar usuário e senha (exemplo)
    public function validarSenha(string $senhaDigitada): bool
    {
        // Aqui você pode implementar a lógica de validação da senha
        // Por exemplo, comparar a senha digitada com a senha do usuário
        return password_verify($senhaDigitada, $this->senha);
    }
}

