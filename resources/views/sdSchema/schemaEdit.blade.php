@extends('layouts.app')
@section('content')
<h1>{{__('Update attendance')}}</h1>
@php
    $userId=$currentUser->id;
    $tableMaxWidth=520;
    $group= $currentUser->groupsize->size;
    if ($group > 1) {
        $tableMaxWidth=700;
    }
@endphp
  <div class="container">
      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">
        <form action="{{ route('sdSchema.updateAttendance')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="trainingId" value="{{$training->id}}">
        <table class="table table-bordered" style="max-width:{{$tableMaxWidth}}px;">
        
            <thead>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Date')}}</th>
              <th class="text-nowrap text-center">{{__('Comment')}}</th>
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
               $radioGroupName='status_'.$userId.'_'.$trainingDate->id;
            @endphp

                     <td>
                     @if ($group===1)
                        <table class="table-sd-schema" style='border:none;'>
                          <tr style='border:none;'>
                            <td style='border:none;width:40px;'><input type="radio" name="{{$radioGroupName}}" value="1" class="status" {{($status==1)?'checked':''}}>
                              <span id="statusSpan">{{__('Yes')}}</span></td>
                            <td style='border:none;width:50px;'><input type="radio" name="{{$radioGroupName}}" value="3" class="status" {{($status==3)?'checked':''}}>
                              <span id="statusSpan">{{__('No')}}</span></td>
                          <!--</tr><tr style='border:none;'>-->
                            <td style='border:none;text-align:center;width:50px;'><input type="radio" name="{{$radioGroupName}}" value="4" class="status" {{($status==4)?'checked':''}}>
                              <span id="statusSpan">{{__('Maybe')}}</span></td>
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
                             <span id="statusSpan">{{__('No')}}</span></td>
                           <td style='border:none;width:70px !important;'><input type="radio" name="{{$radioGroupName}}" value="4" class="status" {{($status==4)?'checked':''}}>
                              <span id="statusSpan">{{__('Maybe')}}</span></td>
                         </tr>
                       </table>
                     @endif
                     </td>

               </tr>
        @endforeach
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
            <button type="cancel" class="btn btn-primary">{{__('Cancel')}}</button>

        </form>
     </div>
 </div>
<!--</div>-->
@endsection
