<?php

    session_start();
    if(isset($_POST['delete'])){
        
        include_once '../Models/conexao.php';

        $sql = "DELETE FROM pedido WHERE ID = :ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":ID",$_POST['delete']);

         if($stmt->execute()){
             $_SESSION['SUCESSO'] = "DELETADO COM SSUCESSO";
            header("Location: ../andamento.php");
        }
        
    }