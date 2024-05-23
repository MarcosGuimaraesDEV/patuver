<?php

// dados para se conectar com o banco de dados! 
$usuario = 'root';
$senha = '1554';
$database = 'login';
$host = 'localhost';

// Configurações de conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $database);

// faz a verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// aqui sempre verificar se um arquivo foi enviado HIHIHIH 
if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK && isset($_FILES["fileToUpload"])) {
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $description = $_POST['fileDescription']; // aqui pega o nome do arquivo HEHE 

    // aqui garda o arquivo pdentro da pasta de upload HEHEH 
    $target_dir = "uploads/";
    $target_file = $target_dir . $filename;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //grava o nome do arquivo e a descrição no banco de dados HEEHEHHE 
        $sql = "INSERT INTO uploads (filename, description) VALUES ('$filename', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo $filename;
        } else {
            echo "Erro ao realizar upload do arquivo: " . $conn->error;
        }
    } else {
        echo "Erro ao realizar upload do arquivo.";
    }
} else {
    echo "Erro ao enviar o arquivo.";
}

// aqui fechar a conexão com o banco de dados
$conn->close();
?>
