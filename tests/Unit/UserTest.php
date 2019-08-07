<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // use RefreshDatabase;

    //  public function test_signup_right_credentials_customer(){
    //     $this->json('POST', 'api/auth/signup', 
    //         [ 
    //             'name' => 'testName',
    //             'email' => 'test@test.com',
    //             'password' => '1234',
    //             'password_confirmation' => '1234',
    //             'phone_number' => '09301434610',
    //             'type' => 'customer'
    //         ]) -> assertStatus(201);
    // }


    public function test_signup_email_validation(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                'email' => 'testtest.com',
                'password' => '1234',
                'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_signup_email_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                // 'email' => 'test@test.com',
                'password' => '1234',
                'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_signup_name_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                // 'name' => 'testName',
                'email' => 'test@test.com',
                'password' => '1234',
                'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_signup_password_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                'email' => 'test@test.com',
                // 'password' => '1234',
                'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_signup_password_confirmation_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                'email' => 'test@test.com',
                'password' => '1234',
                // 'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }


    public function test_signup_phone_number_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                'email' => 'test@test.com',
                'password' => '1234',
                'password_confirmation' => '1234',
                // 'phone_number' => '09301434610',
                'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_signup_type_required(){
        $this->json('POST', 'api/auth/signup', 
            [ 
                'name' => 'testName',
                'email' => 'test@test.com',
                'password' => '1234',
                'password_confirmation' => '1234',
                'phone_number' => '09301434610',
                // 'type' => 'customer'
            ]) -> assertStatus(422);
    }

    public function test_login_email_validation()
    {
        $this->json('POST', 'api/auth/login', ['email' => 'managergmail.com', 'password' => '1234'  ]) -> assertStatus(422);
    }

    public function test_login_email_required() {
        $this->json('POST', 'api/auth/login', [ 'password' => '1234'  ]) -> assertStatus(422);
    }

    public function test_login_password_required() {
        $this->json('POST', 'api/auth/login', ['email' => 'manager@gmail.com' ]) -> assertStatus(422);
    }

    public function test_login_wrong_credentials(){
        $this->json('POST', 'api/auth/login', ['email' => 'managerr@gmail.com', 'password' => '1234'  ]) -> assertStatus(401);
    }

    public function test_login_right_credentials(){
        $this->artisan('passport:install');
        $this->json('POST', 'api/auth/login', ['email' => 'test@test.com', 'password' => '1234'  ]) -> assertStatus(200);
    }


}
