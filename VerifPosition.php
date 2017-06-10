<?php
    
    function verifIDPosition($IDPosition){
        $sql = "SELECT * FROM SPOT.POSITION WHERE IDPosition ="{$IDPosition};
        $result = mysql_query($sql);
        //return 0
        return mysql_num_row($result);
    }
    function verifLongitude($Longitude){
        $sql = "SELECT * FROM SPOT.POSITION WHERE Longitude ="{$Longitude};
        $result = mysql_query($sql);
        //return 0
        return mysql_num_row($result);
    }
    function verifLargeur($Largeur){
        $sql = "SELECT * FROM SPOT.POSITION WHERE Largeur ="{$Largeur};
        $result = mysql_query($sql);
        //return 0
        return mysql_num_row($result);
    }
?>
