<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
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

    public function test_display_view_a_login_form()
    {
        $response = $this->get('/login');
        $response
            ->assertSuccessful()
            ->assertViewIs('auth.login');
    }

    public function test_not_display_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        //actingAs: authenticate a given user as the current user
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

    public function test_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'ngothuyhoa'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        //assertAuthenticatedAs: Assert that the given user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    public function test_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('12345678'),
        ]);
        
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'ngothuyhoa',
        ]);
        
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        //assertGuest: Assert that the user is not authenticated.
        $this->assertGuest();
    }
}
