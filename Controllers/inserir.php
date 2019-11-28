<?php

    session_start();

    if(isset($_POST['nome_pedido'])){

        if(preg_match('/^[\w\s\d]+$/',$_POST['nome_pedido']) && 
            preg_match('/^[\d]+\.?[\d]{2}?$/',$_POST['valor_pedido']) &&
            preg_match('/^[\d]{1,}$/',$_POST['mesa_pedido'])){

                include_once '../Models/conexao.php';

                $sql = "INSERT INTO pedido 
                    VALUES (null,:nome_pedido,:valor_pedido,:mesa_pedido,NOW(),:final)";
                 
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":nome_pedido",$_POST['nome_pedido']);
                $stmt->bindValue(":valor_pedido",$_POST['valor_pedido']);
                $stmt->bindValue(":mesa_pedido",$_POST['mesa_pedido']);
                $stmt->bindValue(":final",0);

                if($stmt->execute()){
                    $_SESSION['SUCESSO'] = "Pedido Realizado com Sucesso";
                    header("Location: ../inserir.php");
                }else{
                    $_SESSION['ERRO'] = "Erro ao Realizar Pedido";
                }


            }else{
                $_SESSION['ERRO'] = "Entrada de Dados Invalidos";
            }
    }else{
        header("Location: ../inserir.php");
    }