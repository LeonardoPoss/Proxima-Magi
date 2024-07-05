async function cadastrar_user() {
    const Caminho = 'src/php/controllers/cadastrouser.php';
    try {
        const nome_user = document.getElementById("input1").value;
        const senha = document.getElementById("pass1").value;
        
        if (nome_user.includes(' ') || senha.includes(' ')) {
            alert('O nome de usuário e a senha não podem conter espaços.');
            return;
        }

        const resposta = await fetch(Caminho, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nome: nome_user, senha: senha })
        });

        // Verificar se a resposta tem sucesso (status 200-299)
        if (!resposta.ok) {
            throw new Error('Erro ao cadastrar usuário: ' + resposta.status);
        }

        const data = await resposta.json();
        console.log(data);
        alert(data.message);
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao processar a solicitação.');
    }
}
