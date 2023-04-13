<?php

if(isset($_POST['submit'])){

    //var_dump($_FILES);
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($_FILES['fileToUpload']['name']); // uploads/gestion-stages.pdf
    
    $uplaodOk = 1;

    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // verifier si le fichier est au bon format
    if($fileType !== 'png' && $fileType !== 'jpeg' && $fileType !== 'pdf' && $fileType !== 'jpg'){
        echo "Extension non autorisé. veuillez choisir les extensions suivantes : png, jpg, jpeg et pdf <br>";
        $uplaodOk = 0;
    }

    // verifier la taille du fichier
    if($_FILES['fileToUpload']['size'] > 2000000){
        echo "la taille du fichier depasse le maximum(2 Mo)  <br>";
        $uplaodOk = 0;
    }

    if(file_exists($target_file)){
        echo $target_file . " is already exists.";
        $uplaodOk = 0;
    }

    if($uplaodOk == 1){
        $uploaded = move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_file);

        if($uploaded == true){
            Echo "Votre fichier est telecharge avec succes <br>";
            Echo "Nom: ". htmlspecialchars(basename($_FILES['fileToUpload']['name']))."<br>";
            Echo "Taille: ". (int)htmlspecialchars(basename($_FILES['fileToUpload']['size']))/1000 ."Ko <br>";
            Echo "Type: ". htmlspecialchars(basename($_FILES['fileToUpload']['type'])) ." <br>";
        }else{
            Echo "Erreur lors de l'enregistrement du fichier";
        }

    } else{
        echo 'Erreur lors du telechargement du fichier';
    }


}