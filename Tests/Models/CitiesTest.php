<?php

namespace Tests\Models;

use App\Models\Cities;
use PHPUnit\Framework\TestCase;


class CitiesTest extends TestCase
{
    public function testSearch()
    {
        $villes = Cities::search("Bord");

        $this->assertIsArray($villes);
        $this->assertNotEmpty($villes);
    }
}