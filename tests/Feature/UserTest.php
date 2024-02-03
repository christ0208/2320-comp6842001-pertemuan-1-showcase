<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test create user, but failed on validation because empty data.
     */
    public function test_create_user_failed_1(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/user');

        $response->assertStatus(422);
    }

    /**
     * A basic feature test create user, but failed on email validation.
     */
    public function test_create_user_failed_2(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/user', [
            'name' => 'John',
            'email' => 'testing',
            'password' => 'password',
            'password_confirmation' => 'testing',
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test create user, but failed on password confirmation.
     */
    public function test_create_user_failed_3(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/user', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'testing',
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test create user, but failed on password min length.
     */
    public function test_create_user_failed_4(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/user', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'asd',
            'password_confirmation' => 'asd',
        ]);

        $response->assertStatus(422);
    }


    /**
     * A basic feature test create user and securely shared data.
     */
    public function test_create_user_success(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/user', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'testingtesting',
            'password_confirmation' => 'testingtesting',
        ]);

        $response->assertJson(function (AssertableJson $json) {
            $json
                ->hasAll(['id', 'name', 'email'])
                ->missingAll(['password', 'remember_token'])
                ->etc();
        });
    }
}
