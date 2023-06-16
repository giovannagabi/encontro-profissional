<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM profissionais WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Localition: listar.php');
    exit;
}

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM profissionais WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Deletar compromisso</title>
</head>
<body>

<div class="principal">
<header>
    <a href="index.html"><img src="./img/logo1.png" height="80px"></a>
</header>
<aside>
    <h1>Deletar compromisso</h1>
    <p style="color: white">Tem certeza que deseja deletar o cadastro de 
        <?php echo $appointment['Nome']; ?>
        com o Email <?php echo ($appointment['Email']); ?>
        e Celular <?php echo ($appointment['Celular']); ?>? </p>
        <div class="form2">
        <form method="post">
        <button type="submit">Sim</button>
        <a href="listar.php">Não</a>
</form>
</div>
</aside>
<footer>
        <div class="logo">
        <img src="./img/log.png" height="80px">
        </div>
        <div class="es">6° Edição do Encontro de Profissionais e 1° Edição do Curso de Altos Estudos de Relações
         Internacionais.</div>

       <div class="rp"> &copy; 2023 Encontro de Profissionais. Todos os direitos reservados.</div>
</footer>

</body>
</html>