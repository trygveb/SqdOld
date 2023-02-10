<?php

namespace App\Models;

use App\Models\Schedule\Groupsize;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmailContract, CanResetPasswordInterface {

   use HasApiTokens,
       HasFactory,
       Notifiable,
       CanResetPassword,
       MustVerifyEmail;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'first_name',
       'middle_name',
       'family_name',
       'email',
       'password',
       'email_verified_at',
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
   ];

   // Override the following functions in trait MustVerifyEmail
   public function markEmailAsVerified() {
      $this->email_verified_at = now();
      $this->save();
   }

   public function hasVerifiedEmail() {
      //dd('hasVerifiedEmail');
      return !is_null($this->email_verified_at);
   }

}
