<!DOCTYPE html>
        <html lang="fr">
        <head>
            <title><?php echo $this->title; ?></title>
        </head>

    <body>
    <p><?php if(key_exists('feedback',$_SESSION))  echo $_SESSION['feedback'];?></p>

    <header>
        <form action="<?php echo $this->router->getPageAccueilURL();?>" method="get"> 
            <input type="submit" value="Page d'accueil"/>
        </form>

        <form action="<?php echo $this->router->getPageAProposURL();?>" method="get"> 
            <br><input type="submit" value="À propos"/>
        </form>

        <form action="<?php echo $this->router->getEndroitCreationURL();?>" method="get"> 
            <br><input type="submit" value="Créer un endroit"/>
        </form>
    </header>
