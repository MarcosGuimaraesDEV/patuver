// Função para mostrar a página correspondente ao link clicado
function showPage(pageId, displayMode = 'block') {
    var sections = document.querySelectorAll('section');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    var selectedPage = document.getElementById(pageId);
    selectedPage.style.display = displayMode;
}

// Nessa parte do codigo eu defini a troca de imagen ao fundo da caixa de senha
function changeBackground() {
    const backgrounds = ['fundo1.jpg', 'fundo2.jpeg', 'fundo3.jpeg', 'fundo4.jpeg' , 'fundo5.jpeg', 'fundo6.jpg', 'fundo7.jpg', 'fundo8.jpeg', 'fundo9.jpeg', 'fundo10.jpg', 'fundo11.jpg' ];
    const randomIndex = Math.floor(Math.random() * backgrounds.length); // Escolhe aleatoriamente um índice da lista
    const newBackground = backgrounds[randomIndex]; // Seleciona a imagem de fundo de maneira aleatória HEHE 

    document.getElementById('dialog-overlay').style.backgroundImage = `url('Arquivos/Fundo/${newBackground}')`; // Atualiza a imagem de fundo
}

// Chamada inicial da função para mudar o fundo
changeBackground();

// Configura um intervalo para mudar a imagem de fundo a cada 1 minuto
setInterval(changeBackground, 60000);

// Senha cifrada
const senhaCifrada = "MTU1NA=="; // Senha codificada em Base64


// Aqui verifico a senha
function checkPassword() {
    const passwordInput = document.getElementById("password").value;
    // Decifra a senha antes de comparar
    const senhaDecifrada = atob(senhaCifrada);
    if (passwordInput === senhaDecifrada) {
        // com a senha correta, permitir acesso ao site
        document.getElementById("dialog-overlay").style.display = "none";
        setTimeout(() => {
            document.getElementById("dialog-overlay").style.display = "flex";
            document.getElementById("password").value = ""; // Limpa o campo de senha
            document.getElementById("password").focus(); // Foca no campo de senha
        }, 60000); // Reexibir a caixa de senha após 1 minuto (60000 milissegundos)
    } else {
        // Senha errada e para mostrar mensagem de erro
        alert("Senha incorreta. Tente novamente.");
    }
}

// Aqui e para quando eu digitar o enter clicar no botão Acessar
document.getElementById("password").addEventListener("keyup", function(event) {
    // aqui verifica se clicou no  "Enter" (código 13)
    if (event.keyCode === 13) {
        // aqui verifica a senha digitada
        checkPassword();
    }
});

/* java cadastra usuarios*/ 



// Função para exibir o pop-up de e-mail já cadastrado
function showPopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'block';
    setTimeout(function() {
        popup.style.display = 'none';
    }, 5000); // Oculta o pop-up após 5 segundos
}

// Função para exibir o pop-up de cadastro realizado com sucesso
function showPopupSuccess() {
    var popup = document.getElementById('popup-success');
    popup.style.display = 'block';
    setTimeout(function() {
        popup.style.display = 'none';
        // Limpar os campos do formulário após o cadastro bem-sucedido
        document.getElementById('nome').value = '';
        document.getElementById('email').value = '';
        document.getElementById('senha').value = '';
    }, 5000); // Oculta o pop-up após 5 segundos
}

// Função para exibir o pop-up de usuário excluído com sucesso
function showPopupExcluido() {
    var popup = document.getElementById('popup-excluido');
    popup.style.display = 'block';
    setTimeout(function() {
        popup.style.display = 'none';
    }, 5000); // Oculta o pop-up após 5 segundos
}

// Função para carregar os usuários cadastrados
function carregarUsuarios() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var usuarios = JSON.parse(xhr.responseText);
                var listaUsuarios = document.getElementById('listaUsuarios');
                listaUsuarios.innerHTML = '';
                usuarios.forEach(function(usuario) {
                    var li = document.createElement('li');
                    li.textContent = usuario.nome + ' - ' + usuario.email;
                    
                    // Adiciona um botão "Excluir" para cada usuário
                    var btnExcluir = document.createElement('button');
                    btnExcluir.textContent = 'Excluir';
                    btnExcluir.onclick = function() {
                        // Mostra o pop-up de confirmação
                        showConfirmation(usuario.email);
                    };
                    li.appendChild(btnExcluir);
                    
                    listaUsuarios.appendChild(li);
                });
            } else {
                console.error('Erro ao carregar os usuários:', xhr.status);
            }
        }
    };
    xhr.open('GET', 'usuarios.php', true);
    xhr.send();
}

// Função para exibir o pop-up de confirmação de exclusão
function showConfirmation(email) {
    var popup = document.getElementById('popup-confirm');
    popup.style.display = 'block';

    // O botão "Sim" confirma a exclusão
    document.getElementById('confirmar-exclusao').onclick = function() {
        // Chama a função para excluir o usuário
        excluirUsuario(email);
        // Fecha o pop-up de confirmação
        popup.style.display = 'none';
        // Exibe o pop-up de usuário excluído com sucesso
        showPopupExcluido();
    };

    // O botão "Não" cancela a ação
    document.getElementById('cancelar-exclusao').onclick = function() {
        // Fecha o pop-up de confirmação
        popup.style.display = 'none';
    };
}

// Função para excluir um usuário
function excluirUsuario(email) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Recarrega a lista de usuários após a exclusão
                carregarUsuarios();
            } else {
                console.error('Erro ao excluir o usuário:', xhr.status);
            }
        }
    };
    xhr.open('POST', 'excluir_usuario.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('email=' + encodeURIComponent(email));
}

// Adiciona um ouvinte de evento para o envio do formulário
document.getElementById('cadastroForm').addEventListener('submit', function(event) {
    // Previne o envio padrão do formulário
    event.preventDefault();
    
    // Envia o formulário usando AJAX
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Se o cadastro for bem-sucedido, exibe o pop-up verde e recarrega os usuários
                showPopupSuccess();
                carregarUsuarios();
            } else if (xhr.status === 409) {
                // Se o e-mail já estiver em uso, exibe o pop-up vermelho
                showPopup();
            } else {
                // Se houver um erro, você pode lidar com isso aqui
                console.error('Erro durante o cadastro:', xhr.status);
            }
        }
    };
    xhr.open('POST', this.action, true);
    xhr.send(formData);
});

// Carrega os usuários ao carregar a página
carregarUsuarios();