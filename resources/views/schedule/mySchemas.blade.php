@extends('schedule.layout')
@section('menu1')
@endsection
@section('content')

  <div class="container">
      <div class="table-responsive" style="overflow-x:auto; overflow-y:hidden;">

        <form id="myForm" action="{{ route('schedule.updateComments')}}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="userId" value="{{Auth::id()}}">
          <fieldset>
            <legend>{{__('Shemas')}}</legend>
            
        <table class="table table-bordered" >
        
            <thead>
              <th style="vertical-align:middle;" class="text-nowrap text-center">{{__('Name')}}</th>
              <th class="text-nowrap text-center" >{{__('Description')}}</th>
              <th class="text-nowrap text-center" >{{__('Member')}}</th>
            </thead>
            <tbody>

        @foreach ($mySchemaIds as $schemaId)
               <tr class='status'>
                  <td class="text-nowrap" >
                      {{$schemaId}}
                  </td>
                  <td class="text-nowrap">
                      Member
                  </td>
                  <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                        <input type="checkbox"   checked name="yes">
                  </td>
               </tr>
        @endforeach
        @foreach ($otherSchemaIds as $schemaId)
               <tr class='status'>
                  <td class="text-nowrap" >
                      {{$schemaId}}
                  </td>
                  <td class="text-nowrap">
                      Not member
                  </td>
                  <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
                        <input type="checkbox"   name="yes">
                  </td>
               </tr>
        @endforeach
            </tbody>
         </table>
            <x-submit-button submitText="{{ __('Save changes')}}" cancelText="{{ __('Cancel')}}" cancelUrl="{{route('schedule.index')}}" />
              </fieldset>

        </form>
     </div>
 </div>
<!--</div>-->
@section('scripts')
@endsection

@endsection
