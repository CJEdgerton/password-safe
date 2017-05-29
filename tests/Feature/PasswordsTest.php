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
}
