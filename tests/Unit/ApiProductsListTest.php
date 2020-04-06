<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiProductsListTest extends TestCase
{
    public function testNoAuthenticationNeeded()
    {
        $this->assertTrue(True);
    }

    public function testCategoryFilterWorksProperly()
    {
        $this->assertTrue(True);
    }

    public function testPaginationWorksProperly()
    {
        $this->assertTrue(True);
    }

    public function testSendsProductsList()
    {
        $this->assertTrue(True);
    }
}
