<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
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
        $response = $this->actingAs($user, 'api')->json('POST', '/business',$data)->assertStatus(422);
        
    }
    
}
