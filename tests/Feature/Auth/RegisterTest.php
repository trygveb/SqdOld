<?php

/**
 * @package AbcTravTest 
 * @author    Trygve Botnen <trygve.botnen@gmail.com>
 * @copyright Copyright (c) 2020 TGB-Data, Sweden
 * 
 */

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Register new user Tests.
 *
 * @since 3.0.0  
 */
class RegisterTest extends TestCase {

   //use RefreshDatabase;

   private $SEEDED_USERS = 2;

   /**
    * Called before each test method
    * @return void
    */
   public function setUp(): void {
      parent::setUp();
      $locale='se';
//      putenv(LaravelLocalization::ENV_ROUTE_KEY);
       putenv(LaravelLocalization::ENV_ROUTE_KEY . '=' . $locale);
      Artisan::call('db:wipe', ['--database' => 'sdCalls']);
      Artisan::call('db:wipe', ['--database' => 'sdSchema']);
      Artisan::call('db:wipe', ['--database' => 'sqd']);
      Artisan::call('migrate');
      \DB::connection('sdSchema')->beginTransaction();
      \DB::connection('sdCalls')->beginTransaction();
      \DB::connection('sqd')->beginTransaction();
   }

   public function tearDown(): void {
      putenv(LaravelLocalization::ENV_ROUTE_KEY);
      \DB::connection('sqd')->rollBack();
      \DB::connection('sdCalls')->rollBack();
      \DB::connection('sdSchema')->rollBack();
      parent::tearDown();
   }

   protected function successfulRegistrationRoute() {
      return route('home');
   }

   protected function registerGetRoute() {
//      return route('showRegisterFormTest', ['application' => 'sdSchema']);
      return route('test.showRegisterForm', ['application' => 'sdSchema']);
   }

   protected function registerPostRoute() {
      return route('custom-registration');
   }

   protected function guestMiddlewareRoute() {
      return route('home');
   }

   public function testUserCanViewARegistrationForm() {
      printf("route=%s\n", $this->registerGetRoute());
      $response = $this->get($this->registerGetRoute());
//      printf("%s \n",print_r($response, true));
      $response->assertSuccessful();
      $response->assertViewIs('auth.registration');
   }

   public function testUserCannotViewARegistrationFormWhenAuthenticated() {
//      $user = factory(User::class)->make();
      $user = User::factory()->make();
      $response = $this->actingAs($user)->get($this->registerGetRoute());

      $response->assertRedirect($this->guestMiddlewareRoute());
   }

   /**
    * Fakes a register event. Tests:
    * * Users count
    * * Created user not null
    * * Correct name and password on new user
    * * Calls abcTravRegisterTest
    * Description
    * */
   public function XtestUserCanRegister() {
      Event::fake();
      $response = $this->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => 'john@example.com',
          'password' => 'i-love-laravel',
          'password_confirmation' => 'i-love-laravel',
      ]);

      $response->assertRedirect($this->successfulRegistrationRoute());
      $this->assertCount($this->SEEDED_USERS + 1, $users = User::all());
      $user = User::where('email', 'john@example.com')->first();
      $this->assertNotNull($user);
//        $this->assertAuthenticatedAs($user = $users->first());
      $this->assertEquals('John Doe', $user->name);
//        $this->assertEquals('john@example.com', $user->email);
      $this->assertTrue(Hash::check('i-love-laravel', $user->password));
      $this->abcTravRegisterTest($user);
      Event::assertDispatched(Registered::class, function ($e) use ($user) {
         return $e->user->id === $user->id;
      });
   }

   public function XtestUserCannotRegisterWithoutName() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => '',
          'email' => 'john@example.com',
          'password' => 'i-love-laravel',
          'password_confirmation' => 'i-love-laravel',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('name');
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function XtestUserCannotRegisterWithoutEmail() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => '',
          'password' => 'i-love-laravel',
          'password_confirmation' => 'i-love-laravel',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('email');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function XtestUserCannotRegisterWithInvalidEmail() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => 'invalid-email',
          'password' => 'i-love-laravel',
          'password_confirmation' => 'i-love-laravel',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('email');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function XtestUserCannotRegisterWithoutPassword() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => 'john@example.com',
          'password' => '',
          'password_confirmation' => '',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('password');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function XtestUserCannotRegisterWithoutPasswordConfirmation() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => 'john@example.com',
          'password' => 'i-love-laravel',
          'password_confirmation' => '',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('password');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function XtestUserCannotRegisterWithPasswordsNotMatching() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => 'John Doe',
          'email' => 'john@example.com',
          'password' => 'i-love-laravel',
          'password_confirmation' => 'i-love-symfony',
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('password');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

}
