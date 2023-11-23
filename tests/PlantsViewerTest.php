<?php
require_once 'src/Plant.php';
require_once 'src/PlantsViewer.php';
use PHPUnit\Framework\TestCase;

class PlantsViewerTest extends TestCase
{  
    public function test_displayAllPlants(): void
    {
        $output = "<div class='all_plants'>";
        $output .= "<h1>Rubber Plant</h1>";
        $output .= "<p>Foliage</p>";
        $output .= "<img src='https://www.beardsanddaisies.co.uk/cdn/shop/products/BD_H_M_231_a859ecdb-9305-45f7-bb9e-4ef95de9a920.jpg?v=1675260237' />";
        $output .= "<p class='description'>TEST</p>";
        $output .= "</div>";

        $plant1 = new Plant("Rubber Plant", 
        "https://www.beardsanddaisies.co.uk/cdn/shop/products/BD_H_M_231_a859ecdb-9305-45f7-bb9e-4ef95de9a920.jpg?v=1675260237", 
        "TEST", 
        "Foliage");

        $result = PlantViewHelper::displayAllPlants([$plant1]);

        $this->assertEquals($output, $result);
}
}