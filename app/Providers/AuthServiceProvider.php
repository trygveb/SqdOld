<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class AuthServiceProvider extends ServiceProvider {

   /**
    * The policy mappings for the application.
    *
    * @var array<class-string, class-string>
    */
   protected $policies = [
           // 'App\Models\Model' => 'App\Policies\ModelPolicy',
   ];

   /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
   public function boot() {
      $this->registerPolicies();

      // Adds current application (schema or call) to the url used in the verify email email,
      //  in order to return to the current application
      VerifyEmail::createUrlUsing(function ($user) {
         return URL::temporarySignedRoute(
                 'verification.verify',
                 Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                 [
                     'id' => $user->getKey(),
                     'hash' => sha1($user->getEmailForVerification()),
                     'application' => $user->application
                 ]
         );
      });
      // Adds current application (schema or call) to the url used in the reset password email,
      //  in order to return to the current application
      ResetPassword::createUrlUsing(function ($user) {
         return URL::temporarySignedRoute(
                 'verification.verify',
                 Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                 [
                     'id' => $user->getKey(),
                     'hash' => sha1($user->getEmailForVerification()),
                     'application' => $user->application
                 ]
         );
      });
   }

}
