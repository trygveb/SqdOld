<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UnixController extends Controller {
   
   public function index() {
      return view('unix.createApacheConfFiles', [
          'fileName1' => '',
          'fileName2' => ''
      ]);
      
   }
   public function createConfigFiles(Request $request) {
      $rootPath = $request->rootPath;
      $subDomain=$request->subDomain;
      
      
      $fileName1= sprintf('%s.se.conf', $subDomain);
      $confText1= view('unix.apacheConf', [
         'rootPath' => $rootPath,
         'subDomain' => $subDomain
      ]);
        
        Storage::put($fileName1, $confText1);

      $fileName2= sprintf('%s.se-le-ssl.conf', $subDomain);
      $confText2= view('unix.apacheConf-ssl', [
         'rootPath' => $rootPath,
         'subDomain' => $subDomain
      ]);
        
        Storage::put($fileName2, $confText2);
      
      return view('unix.createApacheConfFiles', [
          'fileName1' => $fileName1,
          'fileName2' => $fileName2
      ]);
      
   }
   
}