<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="style.css">
    <title>Encontro de profissionais</title>
</head>
<body class="listar">



    <h1>Encontro de profissionais</h1>

    <?php
    $stmt = $pdo->query('SELECT * FROM profissionais ORDER BY Email, Celular');
    $profissionais = $stmt->fetchALL(PDO::FETCH_ASSOC);

    if (count($profissionais)==0) { 
        echo '<p>Nenhum compromisso agendado.</p>';
}else{
    echo '<table>';
    echo '<thead><tr><th>Nome</th><th>Cargo</th><th>Empresa</th><th>Email</th><th>Celular</th><th>CPF/CNPJ</th><th>Idade</th><th colspan="2">Opções</th></tr></thead>';
    echo '<tbody>';

    foreach ($profissionais as $profissional) {
        echo '<tr>';
        echo '<td>' . $profissional['Nome'] . '</td>';
        echo '<td>' . $profissional['Cargo'] . '</td>';
        echo '<td>' . $profissional['Empresa'] . '</td>';
        echo '<td>' . $profissional['Email'] . '</td>';
        echo '<td>' . $profissional['Celular'] . '</td>';
        echo '<td>' . $profissional['CPF_CNPJ'] . '</td>';
        echo '<td>' . $profissional['Idade'] . '</td>';
        echo '<td><a style="color:white;" href="atualizar.php?id=' .
        $profissional['id'] . '">Atualizar</a></td>';
        echo '<td><a style="color:white;" href="deletar.php?id=' .
        $profissional['id'] . '">Deletar</a></td>';
        

    }

    echo '</tbody>';
    echo '</table>';
    }

  

?>

</body>
</html>