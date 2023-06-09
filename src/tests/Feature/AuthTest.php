<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testMustEnterEmailAndPassword() {
        $credentials = ['email' => '','password' => '123456'];

        $failedLogin = $this->json('POST', 'api/login',$credentials,['Accept' => 'application/json'])
        ->assertStatus(422);

        if (empty($credentials["email"]) && empty($credentials["password"])) {
            $failedLogin->assertJson([
                "message" => "The email field is required. (and 1 more error)",
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
        }

        if (empty($credentials["email"]) && !empty($credentials["password"])) {
            $failedLogin->assertJson([
                "message" => "The email field is required.",
                "errors" => [
                    'email' => ["The email field is required."],
                ]
            ]);
        }  

        if (!empty($credentials["email"]) && empty($credentials["password"])) {
            $failedLogin->assertJson([
                "message" => "The password field is required.",
                "errors" => [
                    'password' => ["The password field is required."],
                ]
            ]);
        }
        
       
    }

    public function testSuccessLogin()
    {
        
        $credentials = ['email' => 'admin@admin.com','password' => '123456'];

        $this->json('POST', 'api/login', $credentials, ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonStructure([
            "access_token",
            "token_type",
            "expires_in"
        ]);

        $this->assertAuthenticated();
        
    }
}
