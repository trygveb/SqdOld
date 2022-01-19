@extends('sdSchema.layout')
@section('content')
<h1>{{__('Schedule for')}} {{$training->name}}</h1>
  <div class="container">
      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

        
          
<div class="outer">
  <div class="inner">
         
          <table class="table table-bordered">
        
            <thead style="height:100px; font-size:smaller;">
              <th style="height:100px;padding-top:70px !important;vertical-align:middle;" class="fix text-nowrap text-center">{{__('Date')}}</th>
              <th style="height:100px;" class="text-nowrap text-center">{{__('Comment')}}</th>
             
             
              <th class='vertical'>{{__('Yes')}}</th>
              <th class='vertical'>{{__('No')}}</th>
              <th class='vertical' style="width:30px;">{{__('Maybe')}}</th>
            
        @foreach ($names as $userId => $name)
                <th class="text-nowrap text-center" style="font-size:smaller">{{$name}}</th>
        @endforeach
             </thead>
             <tbody>
        @php
               $i=0;
        @endphp
        @foreach ($trainingDates as $trainingDate)
               <tr class='status'>
               <td class="fix text-nowrap" style="height:32px; padding:2px 7px;">{{$trainingDate->training_date}}</td>
            @php
                  $commentName='comment_'.$trainingDate->id;
            @endphp
               <td style="padding:1px 7px;min-width:15ch;max-width:20ch;" >{{$trainingDate->comment}}</td>
               <td class="text-center">{{$statusSums[$i]['Y']}}</td>
               <td class="text-center">{{$statusSums[$i]['N']}}</td>
               <td class="text-center">{{$statusSums[$i++]['M']}}</td>
            @foreach ( $names as $userId => $name )
                @php
                    $status= $statuses[$userId][$trainingDate->id];
                    $group= $groups[$userId];
                    $statusName='-';
                    switch ($status) {
                      case 1: if ($group==1) {
                                 $statusName='Ja';
                              } else {
                                 $statusName='1';
                              }
                              break;
                      case 2: $statusName='2';
                              break;
                      case 3: $statusName='Nej';
                              break;
                      case 4: $statusName='Kanske';
                              break;
                     }
                     $radioGroupName='status_'.$userId.'_'.$trainingDate->id;
                @endphp
                 <td class="text-center">{{$statusName}}</td>
            @endforeach
               </tr>
        @endforeach
              </tbody>
            </table>

     </div>
 </div>
<!--</div>-->
@endsection
