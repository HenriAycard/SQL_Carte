<?php

    function verifIDPosition($IDPosition){
        $sql = "SELECT * FROM SPOT.POSCARTE WHERE IDPosition ="{$IDPosition};
        $result = mysql_query($sql);
        //return 0
        return mysql_num_row($result);
    }
    function verifIDPosition($IDCarte){
        $sql = "SELECT * FROM SPOT.POSCARTE WHERE IDCarte ="{$IDCarte};
        $result = mysql_query($sql);
        //return 0
        return mysql_num_row($result);
    }
?>
