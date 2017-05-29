<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_authenticated_use_can_create_a_password()
    {
        $this->signIn();
        $password = make('App\Password', ['user_id' => auth()->id()]);

        $this->post(route('passwords.store'), $password->toArray());

        $this->assertDatabaseHas('passwords', [
            'user_id' => auth()->id(), 
            'account' => $password->account
        ]);
    }

    /** @test */
    public function an_unauthenticated_use_cannot_create_a_password()
    {
        $this->withExceptionHandling();

        $this->get(route('passwords.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_user_can_only_see_their_see_their_own_passwords()
    {
        $user = create('App\User');
        $this->signIn($user);

        $password = create('App\Password', ['user_id' => $user->id]);
        $this->get(route('passwords.index'))
            ->assertSee($password->account);

        $another_user = create('App\User');
        $another_users_password = create('App\Password', ['user_id' => $another_user->id]);
        $this->get(route('passwords.index'))
            ->assertDontSee($another_users_password->account);

    }
}
