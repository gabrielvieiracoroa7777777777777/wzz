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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="formulario.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="" method="post">
      <h1>Cadastro</h1>
      <div class="input-box">
        <input type="text" name="email" placeholder="Email" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="senha" placeholder="Senha" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Continuar logado</label>
        <a href="#">Esqueceu a senha?</a>
      </div>
      <button type="submit" class="btn">Cadastrar</button>
    </form>
  </div>
</body>
</html>
