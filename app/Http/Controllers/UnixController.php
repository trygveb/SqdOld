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
          'fileNameSSL' => '',
          'subDomain' => ''
      ]);
      
   }
   public function createConfigFiles(Request $request) {
      $rootPath = $request->rootPath;
      $subDomain=$request->subDomain;
      
      
//      $fileName1= sprintf('%s.se.conf', $subDomain);
//      $confText1= view('unix.apacheConf', [
//         'rootPath' => $rootPath,
//         'subDomain' => $subDomain
//      ]);
//        
//        Storage::put($fileName1, $confText1);
//
      //$fileName2= sprintf('%s.se-le-ssl.conf', $subDomain);
      $fileNameSSL= sprintf('%s.se.conf', $subDomain);
      $confTextSSL= view('unix.apacheConf-ssl', [
         'rootPath' => $rootPath,
         'subDomain' => $subDomain
      ]);
        
        Storage::put($fileNameSSL, $confTextSSL);
      
      return view('unix.createApacheConfFiles', [
          'fileName1' => '',
          'fileNameSSL' => $fileNameSSL,
          'subDomain' => $subDomain
      ]);
      
   }
   
}