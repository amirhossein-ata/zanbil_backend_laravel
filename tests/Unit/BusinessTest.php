<?php

namespace Tests\Unit;

use App\User;
use App\Business;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTest extends TestCase
{
    public function test_add_business_success(){
        $data = [
            'name' => "business test name",
            'description' => "business_test_description",
            'price' => 0,
            'address' => 'business test address'
        ];

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api')->json('POST', '/business',$data)->assertStatus(201);
    }
    public function test_add_business_not_authenticated()
    {
        $data = [
            'name' => "business test name",
            'description' => "business_test_description",
            'price' => 0,
            'address' => 'business test address'
        ];
        
        $response = $this->json('POST', '/business',$data)->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
        
    }
    public function test_add_business_name_required()
    {
        $data = [
            // 'name' => "business test name",
            'description' => "business_test_description",
            'price' => 0,
            'address' => 'business test address'
        ];
        
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api')->json('POST', '/business',$data)->assertStatus(422);
        
    }

    public function test_get_all_business_not_authenticated(){
        $this->json('GET', '/business')
        -> assertStatus(401);
    }

    public function test_get_all_businesses_info(){
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')->json('GET', '/business')
        -> assertStatus(200)
        -> assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'address',
                    'manager',
                    'services',
                    'employers'      
                ]
            ]
        ]);
    
    }

    public function test_get_single_business_not_authenticated(){
        $this->json('GET','/business/1')
        ->assertStatus(401); 
    }

    public function test_get_single_business_info(){
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->json('GET', '/business/1')
        -> assertStatus(200)
        -> assertJson([
            "data" => [
                "id"=> 1,
                "name" => "business test name",
                "description" => "business_test_description",
                "price" => "0.0",
                "address" => "business test address",
                "manager" => [
                    "id" => 4,
                    "name" => "Marina Franecki",
                    "email" => "king.elenora@example.com",
                    "phone" => "(842) 550-0615 x5292"
                ],
                "services" => [
                    "data" => []
                ],
                "employers" => [
                    "data" => []
                ]
            ]
        ]);
    }
    
}
