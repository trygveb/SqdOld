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
   public function createConfigFiles(Request $request) {
      $rootPath = $request->rootPath;
      $subDomain=$request->subDomain;
      
      
      $fileName1= sprintf('%s.conf', $subDomain);
      $generated=Carbon::now();
      $confText1= view('unix.apacheConf', [
         'rootPath' => $rootPath,
         'subDomain' => $subDomain,
          'generated' => $generated
      ]);
        
      Storage::put($fileName1, $confText1);

      $fileNameSSL='';
//      $fileNameSSL= sprintf('%s.ssl.conf', $subDomain);
//      $confTextSSL= view('unix.apacheConf-ssl', [
//         'rootPath' => $rootPath,
//         'subDomain' => $subDomain
//      ]);
        
//        Storage::put($fileNameSSL, $confTextSSL);
      
      return view('unix.createApacheConfFiles', [
          'fileName1' => $fileName1,
          'fileNameSSL' => $fileNameSSL,
          'subDomain' => $subDomain
      ]);
      
   }
   
}