<?php
            require_once 'src/PlantModel.php';

            if (isset($_POST['newPlantName'])&&
                isset($_POST['newPlantScientificName'])&&
                isset($_POST['newPlantFamily'])&&
                isset($_POST['newPlantImage'])&&
                isset($_POST['newPlantDescription'])
                )   {
                        $inputtedPlantName = $_POST['newPlantName']; 
                        $inputtedScientificName = $_POST['newPlantScientificName'];
                        $inputtedPlantFamily = $_POST['newPlantFamily'];
                        $inputtedImage = $_POST['newPlantImage'];
                        $inputtedDescription = $_POST['newPlantDescription'];
                        
                        if(strlen($inputtedPlantName)==0 ||
                        is_numeric($inputtedPlantName)
                            ){
                                echo "Please select use valid characters for the plant name.";
                             }
                        if(intval($inputtedPlantFamily)==0 ||
                        intval($inputtedPlantFamily < 4)
                            ){
                                echo "Please select a valid plant family.";
                             }
                        if(is_numeric($inputtedScientificName) 
                            ){
                                echo "Please select use valid characters for the scientific name.";
                             }
                        if(strlen($inputtedImage)==0 || 
                            filter_var($inputtedImage, FILTER_VALIDATE_URL) === FALSE) 
                            {
                                echo "Please enter a valid image URL.";
                            }
                        if(strlen($inputtedDescription)==0 ||
                        strlen($inputtedDescription) < 10 ||
                        is_numeric($inputtedDescription)
                            ){  
                                echo "Decscription must be at least 10 characters.";
                             }
                        else 
                            {

                                $db = new PDO('mysql:host=db; dbname=plants', 'root', 'password');
                                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                                $plantModel = new PlantModel($db);

                                
                                $success=$plantModel->addNewPlant($inputtedPlantName, 
                                $inputtedScientificName, 
                                $inputtedPlantFamily, 
                                $inputtedImage,
                                $inputtedDescription);
                            }
                    }
            ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="style.css">

        <title>Mr Fancy Plants</title>
    </head>
    <body>
        <header>
            <div class="logo">
                <h1> Mr Fancy Plants </h1>
                <p> Girl, pileas!</p>
            </div>  

            <nav>
                <a href="index.php" class="navButton">Home</a>
                <a href="AddPlant.php" class="navButton">Manage Plants</a>
            </nav>
        </header>
        <section class="managePlants">
            <form method="POST" class="add_plant">

                    <label for="newPlant">Plant Name</label>
                    <input type="text" name="newPlantName" />

                    <label for="newPlantFamily">Select the family</label>
                    <select name="newPlantFamily">
                        <option value="0">--Plant Family--</option>
                        <option value="4">Foliage Plants</option>
                        <option value="1">Succlents and Cacti</option>
                        <option value="3">Flowing Plants</option>
                        <option value="2">Trailing or Hanging Plants</option>
                    </select>
                    
                    <label for="newPlantScientificName">Scientific Name</label>
                    <input type="string" name="newPlantScientificName" />
                    
                    <label for="newPlantImage">Image URL</label>
                    <input type="url" name="newPlantImage" />

                    <label for="newPlantImage">Description</label>
                    <textarea type="text" name="newPlantDescription"></textarea>
                    
                    <input type="submit" class="sumbitPlant"/>
                </form>
        </section>
                <?php
                    if(isset($success)){
                        if($success) {
                            echo 
                            "<div class='submit_success'>";
                            "Your $inputtedPlantName was added to the plant collection";
                            "</div>";
                        } 
                    }
                ?> 
</html>
