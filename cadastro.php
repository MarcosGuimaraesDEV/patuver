<?php
// Configurações de conexão com o banco de dados
$usuario = 'root';
$senha = '1554';
$database = 'login';
$host = 'localhost';

// aqui faz a conexão com o banco de dados! HEHEHE 
$conn = new mysqli($host, $usuario, $senha, $database);

// Aqui testa e verifica se houve algum erro na conexão com o banco de dados HEHEH 
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Nesse codigo faz a verificação do envios das informações pelo post zica vei  HEHE 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aqui colhe as informações do cadastro do formulario HEHEH 
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Essa query para verificar se o e-mail já está sendo usado por alguem  HEHEHE 
    $sql_verificar_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    // Esse codigo e para  verificar se o e-mail já tem, para não usar duas vezes meu jovem... HEHEH 
    if ($result_verificar_email->num_rows > 0) {
        // aqui e para mostrar que o e-mail já está cadastrado.  HOHOHOHO 
        http_response_code(409);
    } else {
        // NEssa query grava os dados no banco de dados HIHIHIHIH 
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        
        if ($conn->query($sql) === TRUE) {
            // NEsse codigo de retorno indica sucesso no cadastro! 
            http_response_code(200);
        } else {
            // Aqui e um codigo para retornar cado de um erro durante o processo de cadastro... HEHEHEH 
            http_response_code(500);
        }
    }
}

// aqui o codigo Fecha a conexão com o banco de dados
$conn->close();
?>
