<?php
// Configurações de conexão com o banco de dados
$usuario = 'root';
$senha = '1554';
$database = 'login';
$host = 'localhost';

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $database);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

//nessa query faz a seleção todos os usuários buchas HEHEH 
$sql = "SELECT * FROM usuarios";


$result = $conn->query($sql);

// nessa array para armazenar todos os usuários ( tudo bucha ) 
$usuarios = array();

// aqui faz uma verificação para ver se há resultados
if ($result->num_rows > 0) {
    // Loop através dos resultados e adiciona os usuários ao array
    while ($row = $result->fetch_assoc()) {
        $usuario = array(
            'nome' => $row['nome'],
            'email' => $row['email']
        );
        array_push($usuarios, $usuario);
    }
}

// aqui fecha a conexão com o banco de dados
$conn->close();

// aqui traz todos os usuários em formato JSON ( os buchas)
header('Content-Type: application/json');
echo json_encode($usuarios);
?>
