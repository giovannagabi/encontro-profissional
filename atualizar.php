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

if(!$appointment) {
    header('Location: listar.php');
    exit;
}
$Nome = $appointment['Nome'];
$Cargo = $appointment['Cargo'];
$Empresa = $appointment['Empresa'];
$Email = $appointment['Email'];
$Celular = $appointment['Celular'];
$CPF_CNPJ = $appointment['CPF_CNPJ'];
$Idade = $appointment['Idade'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Atualizar compromisso</title>
</head>
<body>

<div class="principal">
<header>
    <a href="index.html"><img src="./img/logo1.png" height="80px"></a>
</header>


<div class="container-formulario">
    <h1>Atualizar compromisso</h1>
    <form method="post">

    <label for="Nome">Nome:</label>
    <input type="text" name="Nome" value="<?php echo $Nome; ?>" required><br>

    <label for="Cargo">Cargo:</label>
    <input type="text" name="Cargo" value="<?php echo $Cargo; ?>" required><br>

    <label for="Empresa">Empresa:</label>
    <input type="text" name="Empresa" value="<?php echo $Empresa; ?>" required><br>

    <label for="Email">Email:</label>
    <input type="email" name="Email" value="<?php echo $Email; ?>" required><br>

    <label for="Celular">Celular:</label>
    <input type="tel" name="Celular" value="<?php echo $Celular; ?>" required><br>

    <label for="CPF_CNPJ">CPF/CNPJ:</label>
    <input type="text" name="CPF_CNPJ" value="<?php echo $CPF_CNPJ; ?>" required><br>

    <label for="Idade">Idade:</label>
    <input type="text" name="Idade" value="<?php echo $Idade; ?>" required><br>

    <button type="submit">Atualizar</button>
</form>
</div>

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
<?php
if ($_SERVER['REQUEST_METHOD'] ==  'POST') {
    $Nome = $_POST['Nome'];
    $Cargo = $_POST['Cargo'];
    $Empresa = $_POST['Empresa'];
    $Email = $_POST['Email'];
    $Celular = $_POST['Celular'];
    $CPF_CNPJ = $_POST['CPF_CNPJ'];
    $Idade = $_POST['Idade'];

    //validação dos dados dop formulário aqui
    $stmt = $pdo->prepare('UPDATE profissionais SET Nome = ?, Cargo = ?, Empresa = ?, Email = ?, Celular = ?, CPF_CNPJ = ?, Idade = ? WHERE id = ?');
    $stmt->execute([$Nome, $Cargo, $Empresa, $Email, $Celular, $CPF_CNPJ, $Idade, $id]);
    header('Location: listar.php');
    exit;
}
?>