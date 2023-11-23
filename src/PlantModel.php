
<?php

require_once 'src/Plant.php';

class PlantModel 
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllPlants()
    {
        $query = $this->db->prepare("SELECT `plant`.`name`, 
        `plant_family`.`name` AS `family`, 
        `plant`.`image`, 
        `plant`.`description`
            FROM `plant`
                INNER JOIN `plant_family`
                    ON `plant`.`family_id` = `plant_family`.`id`;");
        $query->execute();
        $plants = $query->fetchAll();
        $plantObjs = [];

        foreach ($plants as $plant) {
            $plantObjs[] = new Plant (
                        $plant['name'],
                        // $plant['scientificName'],
                        $plant['image'],
                        $plant['description'],
                        $plant['family'],
                        // $plant['light_indirect'],
                        // $plant['watering'],
                        // $plant['careDifficulty'],
                        // $plant['soilType'];
            );
        }

        return $plantObjs;
    }

    public function getPlant(int $id): Plant
    {
        $query = $this->db->prepare("SELECT `plant`.`name`, 
        `plant_family`.`name` AS `family`, 
        `plant`.`image`, 
        `plant`.`description`
            FROM `plant`
                INNER JOIN `plant_family`
                    ON `plant`.`family_id` = `plant_family`.`id`;");
        $query->bindParam(':id', $id);
        $query->execute();
        $plant = $query->fetch();
        $plantObj = new Plant (
            $plant['name'],
            // $plant['scientificName'],
            $plant['image'],
            $plant['description'],
            $plant['family'],
            // $plant['light_indirect'],
            // $plant['watering'],
            // $plant['careDifficulty'],
            // $plant['soilType']
        );
        return $plantObj;
    }

    function addNewPlant(string $name, string $scientific_name, int $family_id, string $image, string $description): bool
    {   
        $query = $this->db->prepare(
            'INSERT INTO `plant` 
                (`name`, `scientific_name`,`family_id`, `image`, `description`)
                VALUES (:name, :scientific_name, :family_id, :image, :description);'
            );
        
        $query->bindParam(':name', $name);
        $query->bindParam(':scientific_name', $scientific_name);
        $query->bindParam(':family_id', $family_id);
        $query->bindParam(':image', $image);
        $query->bindParam(':description', $description);
    
    
        $success = $query->execute();

        return $success;
        
    }
}
