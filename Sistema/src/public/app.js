function erro_espaco_login(){
    let aviso_erro = document.getElementById("aviso_erro");
    document.getElementById("input1").value = "";
    document.getElementById("pass1").value = "";
    aviso_erro.showModal();
}
function user_criado(){
    let sucesso = document.getElementById("sucesso");
        document.getElementById("input1").value = "";
        document.getElementById("pass1").value = "";
    sucesso.showModal();
}
async function cadastrar_user() {
    const Caminho = 'Sistema/src/controllers/cadastrouser.php';
    try {
        const nome = document.getElementById("input1").value;
        const senha = document.getElementById("pass1").value;
        
        if (nome.includes(' ') || senha.includes(' ')) {
            erro_espaco_login();
            return;
        }
            const resposta = await fetch(Caminho, {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify({ nome, senha }) 
            });
            if (!resposta.ok) {
                throw new Error(`Erro na requisição: ${resposta.status} ${resposta.statusText}`);
            }
            const dados = await resposta.json();
            console.log(dados);
            user_criado(); 
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao processar a solicitação.');
    }
}

async function login_user() {
    const Caminho = 'Sistema/src/controllers/loginuser.php';
    try {
        const nome = document.getElementById("input1").value;
        const senha = document.getElementById("pass1").value;

        if (nome.includes(' ') || senha.includes(' ')) {
            alert('O nome de usuário e a senha não podem conter espaços.');
            return;
        }

        const resposta = await fetch(Caminho, {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify({ nome, senha }) 
        });

        if (!resposta.ok) {
            throw new Error(`Erro na requisição: ${resposta.status} ${resposta.statusText}`);
        }

        const dados = await resposta.json();
        console.log(dados);

        // Verifica a resposta do servidor
        if (dados.success) {
            alert('Login bem-sucedido!');
            // Redireciona para a página de perfil, por exemplo
            // window.location.href = 'perfil.html';
        } else {
            alert('Nome de usuário ou senha incorretos.');
        }
        
        // Limpa os campos de login após o processamento
        limparCamposLogin();
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao processar a solicitação.');
    }
}

function limparCamposLogin() {
    document.getElementById("input1").value= "";
    document.getElementById("pass1").value= "";
}

