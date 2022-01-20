@extends('layouts.app')
@section('content')

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

        <form id="myForm" action="{{ route('sdSchema.updateComments')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="trainingId" value="{{$training->id}}">
          <fieldset>
            <legend>{{__('Change comments')}}</legend>
            
        <table class="table table-bordered" style="max-width:{{$tableMaxWidth}}px;">
        
            <thead>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Date')}}</th>
              <th class="text-nowrap text-center" style="width:290px;">{{__('Comment')}}</th>
            </thead>
            <tbody>

        @foreach ($trainingDates as $trainingDate)
               <tr class='status'>
                  <td class="text-nowrap" style="max-width:90px !important;height:32px; padding:2px 7px;vertical-align:middle;">{{$trainingDate->training_date}}
                  </td>
            @php
                  $commentName='comment_'.$trainingDate->id;
                  $deleteName='delete_'.$trainingDate->id;
            @endphp
                  <td class="text-nowrap" style="padding:1px 7px;" >
                     <input type="text" maxlength=50 size=40 name="{{$commentName}}" value="{{$trainingDate->comment}}">
                  </td>
               </tr>
        @endforeach
            </tbody>
         </table>
            <x-submit-button submitText="{{ __('Save changes')}}" cancelText="{{ __('Cancel')}}" cancelUrl="{{route('sdSchema.index')}}" />
              </fieldset>

        </form>
     </div>
 </div>
<!--</div>-->
@section('scripts')
@endsection

@endsection
