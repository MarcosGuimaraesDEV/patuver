<?php
$fileToDelete = $_POST['fileToDelete'];
$filePath = "uploads/" . $fileToDelete;
if (file_exists($filePath)) {
    unlink($filePath);
    echo "Arquivo excluído com sucesso: " . $fileToDelete;
} else {
    echo "Erro ao excluir o arquivo: " . $fileToDelete;
}
?>
<?php
$usuario = 'root';
$senha = '1554';
$database = 'login';
$host = 'localhost';

// codigo para se Conectar ao banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha, $database);

// aqui faz uma verificar de conexão com o banco HEHEHHE 
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// nessa parte faz uma verificação do ID do arquivo foi enviado para o banco e servidor
if (isset($_POST['fileId']) && isset($_POST['fileToDelete'])) {
    $fileId = $_POST['fileId'];
    $fileToDelete = $_POST['fileToDelete'];

    // codigo para excluir o arquivo enviado do banco de dados HEHEHEH 
    $sql = "DELETE FROM uploads WHERE id = $fileId";
    if ($conn->query($sql) === TRUE) {
        // Aqui faz a excluisão do arquivo dentro dessa pasta uploads, essa crianda dentro da pasta do Patuver HEHEH 
        $filePath = 'uploads/' . $fileToDelete;
        if (file_exists($filePath)) {
            unlink($filePath); // deleta o arquivo
            echo "Arquivo excluído com sucesso.";
        } else {
            echo "Arquivo não encontrado na pasta de uploads.";
        }
    } else {
        echo "Erro ao excluir o arquivo do banco de dados: " . $conn->error;
    }
} else {
    echo "Erro ao receber o ID do arquivo.";
}

// aqui o codigo Fecha a conexão com o banco de dados
$conn->close();
?>
