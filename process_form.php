<?php
session_start();
include 'includes/db_conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

  
    $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $senha);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Cadastro concluído";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erro na execução da declaração: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Erro na preparação da declaração: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Por favor, preencha todos os campos.";
    $_SESSION['message_type'] = "error";
}


$conn->close();


header("Location: formulario.php");
exit();
?>
