<?php

use App\Models\User;
use function Pest\Laravel\actingAs;


/**
 * When creating a test function we start with it().
 * it() receives two arguments:
 * 1-description
 * 2-closure
 */
it('has a client list page', function() {
    //create a user
    $user = User::factory()->make();//database/factories/UserFactory.php is creating the user

    //go to that page, with the previously created user
    $response = actingAs($user)->get('/admin/clients');

    //check if http status is 200
    $response->assertStatus(200);
});

it('user that acces this page has to be authenticated', function() {
    //go to this page, but this time there is no user, therefore no user login/actingAs...
    $response = $this->get('/admin/clients');
    //...and because of that we expect status 302
    $response->assertStatus(302)->assertRedirect(route('login'));

});