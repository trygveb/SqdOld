@extends('layouts.app')
@section('content')
<h1>Uppdatera närvaro</h1>
@php
    $userId=$currentUser->id;
    $tableMaxWidth=520;
    $group= $currentUser->group;
    if ($group > 1) {
        $tableMaxWidth=700;
    }
@endphp
  <div class="container">
      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">
        <form action="{{ route('schema.updateAttendance')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="trainingId" value="{{$training->id}}">
        <table class="table table-bordered" style="max-width:{{$tableMaxWidth}}px;">
        
            <thead>
              <th style="vertical-align:middle;" class="text-nowrap text-center">Datum</th>
              <th class="text-nowrap text-center">Kommentar</th>
              <th class="text-nowrap text-center">{{$currentUser->name}}</th>
      
             </thead>
             <tbody>

        @foreach ($trainingDates as $trainingDate)
               <tr class='status'>
               <td class="text-nowrap" style="max-width:90px !important;height:32px; padding:2px 7px;vertical-align:middle;">{{$trainingDate->training_date}}</td>
            @php
                  $commentName='comment_'.$trainingDate->id;
            @endphp
               <td style="padding:1px 7px;width:200px;vertical-align:middle;" >{{$trainingDate->comment}}</td>
                @php
                    $status= $statuses[$trainingDate->id];
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

                     <td>
                     @if ($group===1)
                        <table class="table-sd-schema" style='border:none;'>
                          <tr style='border:none;'>
                            <td style='border:none;width:40px;'><input type="radio" name="{{$radioGroupName}}" value="1" class="status" {{($status==1)?'checked':''}}>
                              <span id="statusSpan">Ja</span></td>
                            <td style='border:none;width:50px;'><input type="radio" name="{{$radioGroupName}}" value="3" class="status" {{($status==3)?'checked':''}}>
                              <span id="statusSpan">Nej</span></td>
                          <!--</tr><tr style='border:none;'>-->
                            <td style='border:none;text-align:center;width:50px;'><input type="radio" name="{{$radioGroupName}}" value="4" class="status" {{($status==4)?'checked':''}}>
                              <span id="statusSpan">Kanske</span></td>
                          </tr>
                        </table>
                     @else
                       <table class="table-sd-schema" style='border:none;'>
                         <tr style='border:none;'>
                           <td style='border:none;width:45px;'><input type="radio" name="{{$radioGroupName}}" value="1" class="status" {{($status==1)?'checked':''}}>
                              <span id="statusSpan">1</span></td>
                           <td style='border:none;width:45px;'><input type="radio" name="{{$radioGroupName}}" value="2" class="status"  {{($status==2)?'checked':''}}>
                              <span id="statusSpan">2</span></td>
                         <!--</tr><tr style='border:none;'>-->
                           <td style='border:none;width:55px;'><input type="radio" name="{{$radioGroupName}}" value="3" class="status" {{($status==3)?'checked':''}}>
                             <span id="statusSpan">Nej</span></td>
                           <td style='border:none;width:70px !important;'><input type="radio" name="{{$radioGroupName}}" value="4" class="status" {{($status==4)?'checked':''}}>
                              <span id="statusSpan">Kanske</span></td>
                         </tr>
                       </table>
                     @endif
                     </td>

               </tr>
        @endforeach
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Spara</button>
            <button type="cancel" class="btn btn-primary">Avbryt</button>

        </form>
     </div>
 </div>
<!--</div>-->
@endsection
