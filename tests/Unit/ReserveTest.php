<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResrveTest extends TestCase
{
    // public function test_create_reserve_success(){
        // $user = factory(User::class)->create();
        // $data = [
        //     'service_id' => 1,
        //     'start_time' => '8:30',
        //     'end_time' => '9:30',
        //     'reserve_date' => '9-9-2018',
        // ];
        // $this->actingAs($user, 'api')->json('POST', '/reserve', $data)
        // ->assertStatus(200);
    // }

    public function test_create_reserve_not_authenticated(){
        $data = [
            'service_id' => 1,
            'start_time' => '8:30',
            'end_time' => '9:30',
            'reserve_date' => '9-9-2018',
        ];
        $this->json('POST', '/reserve', $data)
        ->assertStatus(401);
        
    }

    public function test_create_reserve_service_full_time(){
        $user = factory(User::class)->create();
        $data = [
            'service_id' => 1,
            'start_time' => '8:30',
            'end_time' => '9:30',
            'reserve_date' => '9-9-2018',
        ];
        $this->actingAs($user, 'api')->json('POST', '/reserve', $data)
        ->assertStatus(400)
        ->assertJson([
            'message' => 'that time is full for service'
        ]);
    }
    // public function test_create_reserve_customer_full_time(){
    //     $user = factory(User::class)->create();
    //     $first_data = [
    //         'service_id' => 1,
    //         'start_time' => '20:30',
    //         'end_time' => '21:30',
    //         'reserve_date' => '9-9-2018',
    //     ];
    //     $this->actingAs($user, 'api')->json('POST', '/reserve', $first_data)
    //     ->assertStatus(200);

    //     $second_data = [
    //         'service_id' => 2,
    //         'start_time' => '20:30',
    //         'end_time' => '21:30',
    //         'reserve_date' => '9-9-2018',      
    //     ];
    //     $this->actingAs($user, 'api')->json('POST', '/reserve', $second_data)
    //     ->assertStatus(400)
    //     ->assertJson([
    //         'message' => 'that time is full for customer'
    //     ]);   
    // }

    public function test_get_all_reserves_success(){
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api')->json('GET', '/reserve')
        -> assertStatus(200)
        -> assertJsonStructure([
            'data' => [
                '*' => [
                    'reserve_date',
                    'start_time',
                    'end_time',
                    'service',
                    'customer'
                ]
            ]
        ]);
    }

    public function test_get_all_reserve_not_authenticated(){
        $this->json('GET', '/reserve')
        -> assertStatus(401); 
    }
}
