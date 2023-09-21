<?php
require_once 'conectaBD.php';

// ...

if (!empty($_POST)) {
    if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!!!
        try {
            // Preparar as informações
            // Montar a SQL (pgsql)
            $sql = "INSERT INTO anuncio
                (fase, tipo, porte, sexo, pelagem_cor, raca, observacao, email_usuario)
                VALUES
                (:fase, :tipo, :porte, :sexo, :pelagem_cor, :raca, :observacao, :email_usuario)";

            // Preparar a SQL (pdo)
            $stmt = $pdo->prepare($sql);

            // Definir/organizar os dados p/ SQL
            $dados = array(
                ':fase' => $_POST['fase'],
                ':tipo' => $_POST['tipo'],
                ':porte' => $_POST['porte'],
                ':sexo' => $_POST['sexo'],
                ':pelagem_cor' => $_POST['pelagemCor'],
                ':raca' => $_POST['raca'],
                ':observacao' => $_POST['observacao'],
                ':email_usuario' => $_SESSION['email']
            );

            // Tentar Executar a SQL (INSERT)
            // Realizar a inserção das informações no BD (com o PHP)
            if ($stmt->execute($dados)) {
                header("Location: index_logado.php?msgSucesso=Anúncio cadastrado com sucesso!");
                exit; // Encerre o script após redirecionar.
            } else {
                header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio..");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio..");
            exit;
        }
    } elseif ($_POST['enviarDados'] == 'ALT') {
        // Código para ALTERAR
        // ...
    } elseif ($_POST['enviarDados'] == 'DEL') {
        // Código para EXCLUIR
        // ...
    } else {
        header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
        exit;
    }
} else {
    header("Location: index_logado.php?msgErro=Erro de acesso.");
    exit;
}
?>
