<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ClubeTest extends TestCase
{

    public function testShouldCreateClubeInter(){

        $parameters = [
            'Nome' => 'Internacional'
        ];

        $this->post("/api/clube", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome'
            ]
        );
    }

    public function testShouldCreateClubeCaxias(){

        $parameters = [
            'Nome' => 'Caxias'
        ];

        $this->post("/api/clube", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome'
            ]
        );
    }

    public function testShouldGetClubeString(){
        $this->get("/api/clube/a1");
        $this->seeStatusCode(404);
    }

    public function testShouldGetClubeInt(){
        $this->get("/api/clube/1");
        $this->seeStatusCode(200);
    }

    public function testShouldGetAllclubes(){
        $response = $this->call('GET', '/api/clube');
        $this->assertEquals(
            2, count(json_decode($response->content()))
        );
    }

}
