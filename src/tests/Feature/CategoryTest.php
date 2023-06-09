<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
  
    public function testFailedCreateCategory()
    {
        $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXBpL2xvZ2luIiwiaWF0IjoxNjg2Mjk2MDA3LCJleHAiOjE2ODYzMDMyMDcsIm5iZiI6MTY4NjI5NjAwNywianRpIjoiRWg5ZGdEOVRHMVY3ZjlGNyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Jkh_b2LTEZy3vKAbedRqpNG0NU-7CS4TF8gDPVE-zh8";
        $this->json(
                'POST', 
                'api/auth/categories',[
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'],[
                    'Authorization' => $token]
            )
        ->assertStatus(422)
        ->assertJson([
            "message" => "The name field is required.",
            "errors" => [
                'name' => [
                    "The name field is required.",
                ],
            ]
        ]);
    }

    public function testSuccessCreateCategory(){
        $data =["name" => "komputer"];
        $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXBpL2xvZ2luIiwiaWF0IjoxNjg2Mjk2MDA3LCJleHAiOjE2ODYzMDMyMDcsIm5iZiI6MTY4NjI5NjAwNywianRpIjoiRWg5ZGdEOVRHMVY3ZjlGNyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Jkh_b2LTEZy3vKAbedRqpNG0NU-7CS4TF8gDPVE-zh8";
        $this->json(
                'POST', 
                'api/auth/categories',
                $data,[
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $token]
            )
        ->assertStatus(200)
        ->assertOk();
    }
}
