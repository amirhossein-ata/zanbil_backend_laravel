<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Employer;

class ServiceTest extends TestCase
{
    public function test_create_service_success(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(200);
    }

    public function test_create_service_not_authenticated(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->json('POST', '/service', $data)
        -> assertStatus(401);
    }

    public function test_create_service_name_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            // 'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }
    public function test_create_service_business_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            // 'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }
    public function test_create_service_employer_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            // 'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }
    public function test_create_service_startDay_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            // 'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }
    public function test_create_service_endDay_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            // 'end_day' => '18:00',
            'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }
    public function test_create_service_time_length_required(){
        $user = factory(User::class)->create();
        $employer = new Employer([
            'user_id' => $user->id,
            'business_id' => 1
        ]);
        $employer->save();
        $data = [
            'name' => 'service name test',
            'description' => 'service description test',
            'business_id' => 1,
            'employer_id' => $employer->id,
            'price' => 0,
            'address' => 'service address test',
            'start_day' => '08:30',
            'start_middle_rest' => '12:00',
            'end_middle_rest' => '13:00',
            'end_day' => '18:00',
            // 'time_length' => '90',
            'gap_length' => '15'
        ];
        $this->actingAs($user, 'api')->json('POST', '/service', $data)
        -> assertStatus(422);
    }

    public function test_get_all_services_info(){
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')->json('GET', '/service')
        -> assertStatus(200)
        -> assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'address',
                    'employer',
                    'timetable'
                ]
            ]
        ]);
    }

    public function test_get_all_services_not_authenticated(){
        $this->json('GET', '/service')
        ->assertStatus(401);
    }

    public function test_get_single_service_info(){
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')->json('GET', '/service/1')
        ->assertStatus(200)
        ->assertJson([
            "data" => [
                "id" => 1,
                "name" => "service name test",
                "description" => "service description test",
                "price" => "0.0",
                "address" => "service address test",
                "employer" => [
                    "id" => 1,
                    "name" => "Zachery Welch",
                    "email" => "hbogan@example.net",
                    "phone" => "(620) 681-9364 x48649",
                    "start_date" => "2019-08-11T08:47:46.000000Z",
                    "business_name" => "business test name"
                ],
                "timetable" => [
                    "start_day" => "2019-08-11T08:30:00.000000Z",
                    "end_day" => "2019-08-11T18:00:00.000000Z",
                    "start_middle_rest" => "2019-08-11T12:00:00.000000Z",
                    "end_middle_rest" => "2019-08-11T13:00:00.000000Z",
                    "time_length" => "90",
                    "gap_length" => "15",
                    "service_id" => "1"
                ]
            ]
        
        ]);
    }
}
