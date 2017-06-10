<?php
    require 'db.php';
    
    $conn = connection();
    
    //---- VARIABLES ----
    
    $IDClient=$_GET['IDClient'];
    $Nom=$_GET['Nom'];
    $MDP=$_GET['MDP'];
    $Categorie=$_GET['Categorie'];
    $TypePartage=$_GET['TypePartage'];
    
    //---- VERIFIDCLIENT ----
    
    if(verifIDClient($IDClient)!=1)
    {
        printf("1::IDClient false::%s",verifIDClient($IDClient));
        exit;
    }
    
    
    //---- VERIFIDONNEES ----
    $Snom=strlen($Nom);
    
    if ($Snom=0||$Snom>30){
        printf("2::Nom false::%s",$Nom);
        exit;
    }
    
    $SMDP=strlen($MDP);
    
    if ($SMDP>20){
        printf("3::MDP false::%s",$MDP);
        exit;
    }
    
    $SCategorie=strlen($Categorie);
    
    if ($SCategorie>20){
        printf("4::Categorie false::%s",$Categorie);
        exit;
    }
    
    if ($TypePartage >=1&&$TypePartage<=3)
    {
        
    }
    else{
        printf("5::TypePartage false::%s",$TypePartage);
        exit;
    }
    
    //REQUETE SQL
    
    $sql = "INSERT INTO POSITION (IDPosition,Longitude,Latitude) VALUES ("{$IDPosition}","{$Longitude}","{$Latitude}")";
    if (mysql_query($sql)==TRUE){
        echo "0::Succefull";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    mysql_close();
    ?>

