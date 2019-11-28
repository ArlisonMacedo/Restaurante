<?php

    session_start();

    if(isset($_POST['nome_pedido'])){

        if(preg_match('/^[\w\s\dÀ-Úà-ú]+$/',$_POST['nome_pedido']) && 
            preg_match('/^[\d]+\.?[\d]?[\d]?$/',$_POST['valor_pedido']) &&
            preg_match('/^[\d]{1,}$/',$_POST['mesa_pedido'])){

                include_once '../Models/conexao.php';

                $sql = "UPDATE pedido 
                    SET nome_pedido = :nome_pedido, valor_pedido = :valor_pedido,
                    mesa = :mesa_pedido WHERE ID = :ID";
                 
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(":nome_pedido",$_POST['nome_pedido']);
                $stmt->bindValue(":valor_pedido",$_POST['valor_pedido']);
                $stmt->bindValue(":mesa_pedido",$_POST['mesa_pedido']);
                $stmt->bindValue(":ID",$_POST['ID']);

                if($stmt->execute()){
                    $_SESSION['SUCESSO'] = "Pedido Atualizado com Sucesso";
                    header("Location: ../andamento.php");
                }else{
                    $_SESSION['ERRO'] = "Erro ao Realizar Pedido";
                    header("Location: ../andamento.php");
                }


            }else{
                $_SESSION['ERRO'] = "Entrada de Dados Invalidos";
                header("Location: ../update.php");
            }
    }else{
        header("Location: ../inserir.php");
    }