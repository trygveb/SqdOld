<?php

namespace App\Classes;


class Utility {

   public static function getApp() {
      $fullUrl = request()->fullUrl();
      $app='sqd.se';
      if (str_contains($fullUrl, 'schema')) {
         $app='SdSchema';
      } else if (str_contains($fullUrl, 'calls')) {
         $app='SdCalls';
      }
      return $app;
   }

}
