<?php
        $e = $_POST["emaillogin"];
        $p = $_POST["senhalogin"];
        $pold = $_POST["senhaold"];
        
        if($p != $pold){
            echo "<script> alert('Senha inválida') </script>";
        } else {
            
            
        }
            