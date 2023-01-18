<!DOCTYPE html>
        <html lang="fr">
        <head>
            <title>Confirmation</title>
        </head>

    <body>
        <p>Êtes-vous sûr de vouloir supprimer ce lieu?</p>
        <form action="<?php echo $this->router->getEndroitDeletionURL($this->id);?>" method="post">
            <input type="submit" value="Continuer"/>
        </form>

        <form action="<?php echo $this->router->getEndroitPageURL($this->id);?>" method="get">
            <input type="submit" value="Annuler"/>
        </form>
     </body>
</html>