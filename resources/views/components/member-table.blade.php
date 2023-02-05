{{ csrf_field() }}
<input type="hidden" name="scheduleId" value="{{$schedule->id}}">

<legend>{{$legendTitle}} </legend>
<table class="table table-bordered table-sm" style="max-width:250px;">
   <thead style="font-weight:bold; text-decoration-line: underline;">
   <th class="text-nowrap">{{__('Name')}}</th>
   <th class="text-nowrap">{{__('Schema name')}}</th>
   <th class="text-nowrap">{{__('Number')}}</th>
   @if ($connected=="yes")
      <th class="text-nowrap">Admin</th>
   @endif
   <th class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">{{$addRemoveTitle}}</th>
   </thead>
   <tbody>
   @foreach ($vMemberSchedules as $member)
      @php
         $actionName='action_'.$member->user_id;
         $numberName='number_'.$member->user_id;
         $adminName='admin_'.$member->user_id;
         $nameInSchemaName='nameInSchema_'.$member->user_id;
      @endphp
      <tr class='status'>
         <td class="text-nowrap" >{{$member->user_name}}</td>
         <td class="text-nowrap" >
            <input type="text" maxlength=12 size=12 name="{{$nameInSchemaName}}" required value="{{$member->name_in_schema}}">
         </td>
         <td class="text-nowrap" >
            <input type="number" size="3" min="1" max="2" value="{{$member->group_size}}"  name={{"$numberName"}} >
         </td>
         @if ($connected=="yes")
            <td style="padding:2px 5px 2px 5px;" class="text-center">
            @if ($member->admin == 1)
               <input type="checkbox"  class="cbAdmin"  name="{{$adminName}}" onclick="adminClicked(event)" checked>
            @else
               <input type="checkbox"  class="cbAdmin"  name="{{$adminName}}" onclick="adminClicked(event)">
            @endif
         @endif
         </td>
         <td class="text-nowrap text-center" style="padding:2px 5px 2px 5px;">
             <input type="checkbox"  class="cbAction"  name="{{$actionName}}">
         </td>
      </tr>
   @endforeach
   </tbody>
</table>
<br>
