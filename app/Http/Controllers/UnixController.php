<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UnixController extends Controller {

   public function index() {
      return view('unix.createApacheConfFiles', [
          'fileName1' => '',
          'fileNameSSL' => '',
          'subDomain' => ''
      ]);
   }

   public function createConfigFile(Request $request) {
      $rootPath = $request->rootPath;
      $subDomain = $request->subDomain;
      $fileName1 = $this->createOneConfigFile($rootPath, $subDomain);
      return view('unix.createApacheConfFiles', [
          'fileName1' => $fileName1,
          'subDomain' => $subDomain
      ]);
   }

   public function createAllConfigFiles(Request $request) {
      $rootPaths = array(
          'sqd.se' => 'sqd.se',
          'test.sqd.se' => 'sqd.se/test',
          'calls.sqd.se' => 'sqd.se/calls',
          'calls.test.sqd.se' => 'sqd.se/test/calls',
          'schema.sqd.se' => 'sqd.se/schema',
          'schema.test.sqd.se' => 'sqd.se/test/schema',
      );
      foreach ($rootPaths as $subDomain => $rootPath) {
         $this->createOneConfigFile($rootPath, $subDomain);
      }
      return view('unix.createApacheConfFiles', [
          'fileName1' => 'All',
          'subDomain' => 'sqd.se'
      ]);
   }

   private function createOneConfigFile($rootPath, $subDomain) {
      $fileName1 = sprintf('%s.conf', $subDomain);
      $generated = Carbon::now();
      $confText1 = view('unix.apacheConf', [
          'rootPath' => $rootPath,
          'subDomain' => $subDomain,
          'generated' => $generated
      ]);

      Storage::put($fileName1, $confText1);
      return $fileName1;
   }

}
