<?php
declare(strict_types=1); 

require_once 'src/Plant.php';
// <link rel="stylesheet" href="style.css">

class PlantViewHelper
{
    public static function displayAllPlants (array $plants): string
    {
        $output = '';
        
        foreach ($plants as $plant) {
            $output .= "<div class='all_plants'>";
            $output .= "<h1>$plant->name</h1>";
            $output .= "<p>$plant->family</p>";
            $output .= "<img src='$plant->image' />";
            $output .= "<p class='description'>$plant->description</p>";
            $output .= "</div>";
        }

        return $output;
    }

    public static function displaySinglePlant (Plant $plant): string
    {
        $output = "<div class='individual_plants'>";
        $output .= "<h1>$plant->name</h1>";
        $output .= "<p>$plant->family</p>";
        $output .= "<img src='$plant->image' />";
        $output .= "<p class='description'>$plant->description</p>";
        $output .= "</div>";

        return $output;
    }
}