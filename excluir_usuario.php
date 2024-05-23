<?php
// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o e-mail do usuário a ser excluído foi enviado na requisição POST
    if (isset($_POST['email'])) {
        // Recupera o e-mail do usuário a ser excluído da requisição POST
        $email = $_POST['email'];

        // Configurações de conexão do banco de dados. 
        $usuario = 'root';
        $senha = '1554';
        $database = 'login';
        $host = 'localhost';

        // aqui faz a conexão com o banco de dados   HEHEHE 
        $conn = new mysqli($host, $usuario, $senha, $database);

        //  aqui faz uma verificação pra saber se teve algum erro de conexão com o banco HEHEHEH 
         if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // nessa query e para excluir o usuário do banco de dados  ( Apagar o cidadão chefe.)
        $sql = "DELETE FROM usuarios WHERE email = '$email'";

        // Executa a query
        if ($conn->query($sql) === TRUE) {
            
            //Aqui nesse codigo confirma se a excluão estive funcionado certinho HEHEHE 
            http_response_code(200);
        } else {
            // Se não conseguir excluir o usuario retorna essa mensagem bucha aqui HEHEH 
            http_response_code(500);
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Se o e-mail do cidadão não foi enviado na requisição via  POST, retorna um código de status 400 (dizendo que esta invalido)  Bucha HEHEH 
        http_response_code(400);
    }
} else {
    // Se a solicitação não for do tipo POST, retorna esse codigo 405 que e  (sem permissão )   hehehe
    http_response_code(405);
}
?>
