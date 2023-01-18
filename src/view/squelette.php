<?php include "squeletteHeader.php"; ?>

        <h1><?php echo "Page sur " . $this->name;?></h1>
        <p>Votre destination est <?php echo $this->name;?>, le prix est <?php echo $this->price; ?>€ et le date de depart est <?php echo $this->date;?> </p>

        <form action="<?php echo $this->router->getEndroitAskDeletionURL($id);?>" method="get"> 
            <br><input type="submit" value="Supprimer"/>
        </form>

        <form action="<?php echo $this->router->getEndroitModificationURL($id);?>" method="get"> 
            <br><input type="submit" value="Modifier"/>
        </form>
    </body>
</html>