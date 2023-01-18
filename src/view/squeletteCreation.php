<?php include "squeletteHeader.php"; ?>
        <h1><?php echo $this->title;?></h1>
        
        <br><form action=<?php echo $url;?> method="post">
            <label>Nom: <input type="text" name="name" value =" <?php echo $name;?>"></label><br><br>
            <label>Prix: <input type="number" min= 0 step="0.01" name="price" value= '<?php echo $price;?>'></label><br><br>
            <label>Date: <input type="date" name="date" min="2022-11-19" max="2024-01-01" value="<?php echo $date;?>"></label><br><br>
            <br>
            <input type="submit" value="Envoyer"/><br>
            
        </form>
        

        <p style="color:red"><?php echo $error;?></p>
     </body>
</html>