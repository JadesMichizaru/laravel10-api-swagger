<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'username' => 'Jades',
            'password' => '1234',
            'name' => 'Jades',
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'username' => 'Jades',
                    'name' => 'Jades',
                ]
            ]);
    }
    public function testRegisterFailed()
    {
        $this->post('/api/users', [
            'username' => '',
            'password' => '',
            'name' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "The username field is required"
                    ],
                    'password' => [
                        "The password field is required"
                    ],
                    'name' => [
                        "The name field is required"
                    ],
                ]
            ]);
    }
    public function testRegisterAlreadyExistUsername() {
        $this->testRegisterSuccess();
        $this->post('/api/users', [
            'username' => 'Jades',
            'password' => '1234',
            'name' => 'Jades',
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "username already registered"
                    ]
                ]
            ]);
    }
}
