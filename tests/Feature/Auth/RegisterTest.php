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
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Register new user Tests.
 *
 * @since 3.0.0  
 */
class RegisterTest extends TestCase {

   //use RefreshDatabase;

   private $SEEDED_USERS = 0;
   private $testUserName= 'John Doe';
   private $testUserEmail= 'john@example.com';
   private $testUserCorrectpassword= 'Qwerty123';
   private $testApplication= 'sdSchema';

    public static function setUpBeforeClass(): void
    {
//        fwrite(STDOUT, __METHOD__ . "\n");
    }
   
    public static function tearDownAfterClass(): void
    {
//        fwrite(STDOUT, __METHOD__ . "\n");
    }
   /**
    * Called before each test method
    * @return void
    */
   public function setUp(): void {
      parent::setUp();
      Artisan::call('db:wipe', ['--database' => 'sdCalls']);
      Artisan::call('db:wipe', ['--database' => 'sdSchema']);
      Artisan::call('db:wipe', ['--database' => 'sqd']);
      Artisan::call('migrate');
      \DB::connection('sdSchema')->beginTransaction();
      \DB::connection('sdCalls')->beginTransaction();
      \DB::connection('sqd')->beginTransaction();
   }

   public function tearDown(): void {
//      putenv(LaravelLocalization::ENV_ROUTE_KEY);
      \DB::connection('sqd')->rollBack();
      \DB::connection('sdCalls')->rollBack();
      \DB::connection('sdSchema')->rollBack();
      parent::tearDown();
   }

   protected function successfulRegistrationRoute() {
      return route('verification.notice', ['application' => 'sdSchema']);
   }

   protected function registerGetRoute() {
      return route('showRegisterForm', ['application' => 'sdSchema']);
   }

   protected function registerPostRoute() {
      return route('register.custom');
//      return 'se/registration/sdSchema';
   }

   protected function guestMiddlewareRoute() {
      return route('home');
   }

   public function testUserCanViewARegistrationForm() {
      $response = $this->get($this->registerGetRoute());
      $response->assertSuccessful();
      $response->assertViewIs('auth.registration');
   }

   public function testUserCannotViewARegistrationFormWhenAuthenticated() {
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
   public function testUserCanRegister() {
      Event::fake();
      $response = $this->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => $this->testUserEmail,
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => $this->testUserCorrectpassword,
          'application' => $this->testApplication,
      ]);

      $this->assertCount($this->SEEDED_USERS + 1, $users = User::all());
      $response->assertRedirect($this->successfulRegistrationRoute());
      $user = User::where('email', $this->testUserEmail)->first();
      $this->assertNotNull($user);
      $this->assertAuthenticatedAs($user = $users->first());
      $this->assertEquals($this->testUserName, $user->name);
      $this->assertTrue(Hash::check($this->testUserCorrectpassword, $user->password));
      Event::assertDispatched(Registered::class, function ($e) use ($user) {
         return $e->user->id === $user->id;
      });
   }

   public function testUserCannotRegisterWithoutName() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => '',
          'email' => $this->testUserEmail,
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => $this->testUserCorrectpassword,
          'application' => $this->testApplication,
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('name');
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function testUserCannotRegisterWithoutEmail() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => '',
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => $this->testUserCorrectpassword,
          'application' => $this->testApplication,
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('email');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function testUserCannotRegisterWithInvalidEmail() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => 'putte',
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => $this->testUserCorrectpassword,
          'application' => $this->testApplication,
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

   public function testUserCannotRegisterWithoutPassword() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => $this->testUserEmail,
          'password' => '',
          'password_confirmation' => '',
          'application' => $this->testApplication,
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

   public function testUserCannotRegisterWithoutPasswordConfirmation() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => $this->testUserEmail,
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => '',
          'application' => $this->testApplication,
      ]);

      $users = User::all();

      $this->assertCount($this->SEEDED_USERS, $users);
      $response->assertRedirect($this->registerGetRoute());
      $response->assertSessionHasErrors('password_confirmation');
      $this->assertTrue(session()->hasOldInput('name'));
      $this->assertTrue(session()->hasOldInput('email'));
      $this->assertFalse(session()->hasOldInput('password'));
      $this->assertGuest();
   }

   public function testUserCannotRegisterWithPasswordsNotMatching() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => $this->testUserEmail,
          'password' => $this->testUserCorrectpassword,
          'password_confirmation' => 'helloDolly',
          'application' => $this->testApplication,
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
   
   public function testUserCannotRegisterWithIllFormattedPasswords() {
      $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
          'name' => $this->testUserName,
          'email' => $this->testUserEmail,
          'password' => 'helloDolly',
          'password_confirmation' => 'helloDolly',
          'application' => $this->testApplication,
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
