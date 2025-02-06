<?php
    //secu
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    //verifier si le formulaire a été envoyé
    if(isset($_POST['nom']))
    {
        //vérifier si formulaire a envoyé des données
//initialiser une variable erreur à 0 pour dire pas encore d'erreur à ce stade
        $err=0;

        //tester chaque nom du form
        if(empty($_POST['nom']))
        {
            //vrai
            $err=1;
        }else{
            //faux
            //protection de la donnée pcq elle vient de l'ext
            $nom = htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['categorie']))
        {
            $err=2;
        }else{
            $categorie = htmlspeciachars($_POST['categorie']);
        }
        if(empty($_POST['introduction']))
        {
            $err=3;
        }else{
            $introduction = htmlspeciachars($_POST['introduction']);
        }
        if(empty($_POST['description']))
        {
            $err=4;
        }else{
            $descriptione = htmlspeciachars($_POST['description']);
        }
        if(empty($_POST['image']))
        {
            $err=5;
        }else{
            $images = htmlspeciachars($_POST['image']);
        }

        //tester si erreur
        if($err == 0)
        {
            //pes d'errur
            //insertion dans bdd
            //chercher la bdd ( attention ext)
            require "../connexion.php";  
            //insérer dans la bddd avec PDO et SQL
            $insert = $bdd->prepare("INSERT INTO etablissements(nom,introduction,description,image,categorie) VALUES(:nom,:intro,:descri,:img,:cat)");
            $insert->execute([
                ":nom" => $nom,
                ":intro" => $introduction,
                ":descri" => $description,
                ":img" => $image,
                ":cat" => $categorie
            ])     
            $insert->closeCursor();
            //rediriger vers le tableau des écoles avec un signalement
            header("LOCATION:scholls.php?insert=success");

        }else{
            //si au - 1err
            //redirige vers le form avec code erreur 
            header("LOCATION:addSchools.php?error=".$err);
        }


    }else{
        header("LOCATION:addSchools.php");
    }

?>