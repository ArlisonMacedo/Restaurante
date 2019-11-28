<?php

    session_start();
    
    if(isset($_POST['finalizar'])){

        include_once '../Models/conexao.php';

        $sql = "UPDATE pedido SET final = :final WHERE ID = :ID";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":final",1);
        $stmt->bindValue(":ID",$_POST['finalizar']);
        if($stmt->execute()){
            $_SESSION['SUCESSO'] = "PEDIDO REALIZADO COM SUCESSO";
            header("Location: ../andamento.php");
        }

    }