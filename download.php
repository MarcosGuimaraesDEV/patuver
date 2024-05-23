<?php
// Verificar se o parâmetro 'file' está presente na URL
if(isset($_GET['file'])) {
    // Pega o nome do arquivo para baixado   HEHEHHE 
    $filename = $_GET['file'];
    
    // todos os arquivos enviados na guia painel Uploads vai ficar salvo nessa pasta HEHHE 
    $directory = 'uploads/';
    
    // Equi fica registrado o caminho do arquivo HEHEHEH 
    $filepath = $directory . $filename;
    
    // nesse codigo faz uma verificação para saber se a bucha o arquivo existe kkkkkkkkkkk 
    if(file_exists($filepath)) {
        // a definição do cabeçalho para forçar o download do arquivo ta liga obriga a baixar HIHIHIHIH 
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Nessa parte do codigo ele faz uma analise do arquivos para enviá-lo para o navegador 
        readfile($filepath);
        exit;
    } else {
        echo 'Arquivo não encontrado.';
    }
} else {
    echo 'Nome do arquivo não especificado.';
}
?>
