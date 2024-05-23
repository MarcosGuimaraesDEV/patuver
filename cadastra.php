<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #89f073;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }
    </style>
</head>
<body>

<h2>Cadastro de Usuário</h2>
<form id="cadastroForm" action="cadastro.php" method="post">
    <span>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
    </span>
    <span>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </span>
    <span>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </span>
    <input type="submit" value="Cadastrar">
</form>

<div id="popup">Cadastro realizado com sucesso!</div>

<h2>Usuários Cadastrados</h2>
<ul id="listaUsuarios">
    <!-- Os usuários cadastrados vai aparecer aqui manow HEHEH  -->
</ul>

<script>
    // Aqui e para exibir o pop-up
    function showPopup() {
        var popup = document.getElementById('popup');
        popup.style.display = 'block';
        setTimeout(function() {
            popup.style.display = 'none';
        }, 5000); // Aqui depois de 5 segundos Oculta o pop-up  HEHEHE 
    }

    // Aqui carregar os usuários cadastrados  HEHEHE 
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

    // Aqui verifica o envio do formulário 
    document.getElementById('cadastroForm').addEventListener('submit', function(event) {
        // Aqui e para prevenir o formulario que e padrão truta! 
        event.preventDefault();
        
        // Envia o formulário usando o  AJAX bucha vei HEHEHEH 
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Quando eu finalizo o cadastro com sucesso vai exibe o pop-up e depois mostra todos os usuários HEHEH 
                    showPopup();
                    carregarUsuarios();
                } else {
                    // Se tiver algum erro no cadastro vai retornar essa mensagem vei ai tu sabe HEHEH 
                    console.error('Erro durante o cadastro:', xhr.status);
                }
            }
        };
        xhr.open('POST', this.action, true);
        xhr.send(formData);
    });

    // Aqui lista todos os usuario, carrega todos eles quando carrego a página HEHEH !! 
    carregarUsuarios();
</script>

</body>
</html>
