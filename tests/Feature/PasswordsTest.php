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
    public function an_unauthenticated_user_cannot_do_anything()
    {
        $this->withExceptionHandling();
        $password = create('App\Password');

        $this->get(route('passwords.index'))->assertRedirect(route('login'));

        $this->get(route('passwords.create'))->assertRedirect(route('login'));

        $this->get(route('passwords.edit', ['id' => $password->id]))->assertRedirect(route('login'));
            
        $this->post(route('passwords.store'))->assertRedirect(route('login'));
            
        $this->patch(route('passwords.update', ['id' => $password->id]))->assertRedirect(route('login'));

        $this->delete(route('passwords.destroy', ['id' => $password->id]))->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_a_password()
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
    public function an_authenticated_user_can_only_see_their_see_their_own_passwords()
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

    /** @test */
    public function an_authenticated_user_can_only_edit_their_own_password()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $this->signIn($user);

        $password = create('App\Password', ['user_id' => $user->id]);

        $this->get(route('passwords.edit', ['id' => $password->id]))
            ->assertStatus(200);

        $another_user = create('App\User');
        $another_users_password = create('App\Password', ['user_id' => $another_user->id]);
        $this->get(route('passwords.edit', ['id' => $another_users_password->id]))
            ->assertStatus(403);

    }

    /** @test */
    public function an_authenticated_user_can_only_update_their_own_password()
    {
        $this->withExceptionHandling();
        
        $user = create('App\User');
        $this->signIn($user);

        $password = create('App\Password', ['user_id' => $user->id]);

        $this->patch(
            route('passwords.update', ['id' => $password->id]), 
            $password->toArray() 
        )->assertRedirect(route('passwords.index'));

        $another_user = create('App\User');
        $another_users_password = create('App\Password', ['user_id' => $another_user->id]);
        $this->patch(
            route('passwords.update', ['id' => $another_users_password->id]),
            $another_users_password->toArray()
        )->assertStatus(403);

    }

    /** @test */
    public function an_authenticated_user_can_only_delete_their_own_password()
    {
        $this->withExceptionHandling();
        
        $user = create('App\User');
        $this->signIn($user);

        $password = create('App\Password', ['user_id' => $user->id]);

        $this->delete(
            route('passwords.destroy', ['id' => $password->id]), 
            $password->toArray() 
        ); 
        $this->assertDatabaseMissing('passwords', ['id' => $password->id]);

        $another_user = create('App\User');
        $another_users_password = create('App\Password', ['user_id' => $another_user->id]);
        $this->delete(
            route('passwords.destroy', ['id' => $another_users_password->id]), 
            $password->toArray() 
        )->assertStatus(403);

    } 
}
