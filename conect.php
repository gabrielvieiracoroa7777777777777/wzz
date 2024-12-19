<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastros";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
echo "Conectado<br>";


if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    
    $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $senha);

        if ($stmt->execute()) {
            echo "Cadastro concluído";
        } else {
            echo "Erro na execução da declaração: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conn->error;
    }
} else {
    echo "Por favor, preencha todos os campos.";
}

$conn->close();
?>
