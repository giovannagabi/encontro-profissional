<?php 
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Encontro de profissionais</title>
 
</head>
<body>


   <div class="principal">
<header>
    <a href="index.html"><img src="./img/logo1.png" height="80px"></a>
</header>


    <div class="container-formulario">
        <h1>Encontro de profissionais</h1>
        <?php 
        if (isset($_POST['submit'])){
            $Nome = $_POST['Nome'];
            $Cargo = $_POST['Cargo'];
            $Empresa = $_POST['Empresa'];
            $Email = $_POST['Email'];
            $Celular = $_POST['Celular'];
            $CPF_CNPJ = $_POST['CPF_CNPJ'];
            $Idade = $_POST['Idade'];
            
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM profissionais WHERE Email = ? AND Celular = ?');
            $stmt->execute([$Email, $Celular]);
            $count = $stmt->fetchColumn();
            
            if ($count > 0){
                $error = 'Já existe um cadastro com essas informações.';}
            else{
                $stmt = $pdo->prepare('INSERT INTO profissionais (Nome, Cargo, Empresa, Email, Celular, CPF_CNPJ, Idade)
                VALUES (:Nome, :Cargo, :Empresa, :Email, :Celular, :CPF_CNPJ, :Idade)');
                $stmt->execute(['Nome' => $Nome, 'Cargo' => $Cargo, 'Empresa' => $Empresa, 'Email' => $Email, 'Celular' => $Celular,
                'CPF_CNPJ' => $CPF_CNPJ, 'Idade' =>$Idade]);

                if ($stmt->rowCount()){
                    echo '<span>Pofissional agendado com sucesso!</span>';
                }else{
                    echo '<span>Erro ao cadastrar. Tente novamente mais tarde!</span>';
                }

            }

            if (isset($error)) {
                echo '<span>' . $error . '</span>';
            }
        }
?>

<form method="post">

<label for="Nome">Nome:</label>
<input type="text" name="Nome" required><br>

<label for="Cargo">Cargo:</label>
<input type="text" name="Cargo" required><br>

<label for="Empresa">Empresa:</label>
<input type="text" name="Empresa" required><br>

<label for="Email">Email:</label>
<input type="email" name="Email" required><br>

<label for="Celular">Celular:</label>
<input type="tel" name="Celular" maxlenght="11" required><br>

<label for="CPF_CNPJ">CPF/CNPJ:</label>
<input type="text" name="CPF_CNPJ" required><br>

<label for="Idade">Idade:</label>
<input type="text" name="Idade" required><br>

    <div>
    <button type="submit" name="submit" value="Agendar">Agendar</button>
    <button><a href="listar.php">Listar</a></button>
    </div>

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