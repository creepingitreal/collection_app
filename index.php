<?php
    require_once 'src/PlantModel.php';
    require_once 'src/PlantsViewer.php';

    $db = new PDO('mysql:host=db; dbname=plants', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $plantModel = new PlantModel($db);
    
    $plants = $plantModel->getAllPlants();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700;800&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">

        <title>Mr Fancy Plants</title>

    </head>
    <body>
        <header>
            <div class="logo">
                <h1> Mr Fancy Plants </h1>
                <p> Girl, pileas!</p>
            </div>
        </header>
        <div class="plants_display">
            <?php
                echo PlantViewHelper::displayAllPlants($plants);
            ?>
        </div>

        <form method="POST">
            <input type="text" name="newPlant" />
            <input type="submit" />
        </form>
    </body>
</html>



<?php
// Check to make sure the form is submitted
if (isset($_POST['newPlant'])) {
    // If it is, connect to the database
    $db = new PDO('mysql:host=db; dbname=plants', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Get the value out of the form using $_POST
    $inputtedPlant = $_POST['newPlant']; 

    // prepare our insert query, passing the data from the form into the query
    // WE NEVER put variables directly into a query - especially when they come from a user (form)
    // Istead we create a placeholder :category
    $query = $db->prepare("INSERT INTO `plant` (`name`) VALUE (:plant);");
    // And we use bindParam to replace the placeholder with the real data, whilst making it safe automatically
    $query->bindParam(':plant', $inputtedPlant);

    $success = $query->execute(); // execute returns a bool to tell you if the query worked or not
    // If execute returns true, display a success message
    if ($success) {
        echo "$inputtedPlant was inserted into the DB";
    } else { // Display an error if excute failed for whatever reason
        echo "Error, try again later!";
    }
} 