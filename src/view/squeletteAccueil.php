<?php include "squeletteHeader.php"; ?>

        <h1><?php echo "Top 10 des endroits où voyager en été 2023!!!"?></h1>
        <h4><?php echo "Voici une liste des meilleures destinations où voyager pour des vacances d'été incroyables";?></h4>
        <br>
        <nav>
            <ol>
            <?php 
            for($i=0; $i<sizeof($this->list); $i++) {
            
                echo  "<li><a href= 'https://dev-22012535.users.info.unicaen.fr/dm-tw4b-2022/endroits.php/" . $this->list[$i] 
                . "'>" . $endroitsTab[$this->list[$i]]->getName() . "</a></li>";
            }
            ?>
            </ol>
        </nav>
    </body>
</html>