<?php

namespace Tests;

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * @test
     */
    public function testExample(){
        User::factory()->count(10)->create();

        $this->assertCount(10, User::all());
    }

    /**
     * @test
     */
    public function testExample2(){

        $response = $this->get('/foo');
        $response->assertResponseOk();
    }
}
