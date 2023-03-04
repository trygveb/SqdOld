@extends('schedule.layout')

@section('content')


<div class="container">
    <h1 class="text-center"> {{ __('Release notes')}} for {{$names['application']}}  Version 2.2 </h1>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #73AD21;  padding: 10px;">

      <h2>Administration</h2>
      <ul>
          <li>Sidan för att skapa nytt schema uppdaterad</li>
         <ul>
             <li>Fält för beskrivning</li>
            <li>Fält för "Namn i schema" för den som skapar schemat</li>
         </ul>
      </ul>
    
   </div>    
</div>
@endsection
