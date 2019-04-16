<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;


class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     public function test_register_a_account()
    {

        $response = $this->post('register', [
            'name' => 'ngothuyhoa',
            'email' => 'hoa@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);


        $response->assertStatus(302);
        $response->assertRedirect('/home');

        $this->assertAuthenticated();
    }
}
