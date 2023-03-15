@extends('schedule.layout')

@section('content')


<div class="container">
    <h1 class="text-center"> {{ __('Release notes')}} for {{$names['application']}}  Version 2.2 </h1>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #ca7300;  padding: 10px;">
      <h2>För Schemaskapare</h2>
      <ul>
          <li>Sidan för att skapa nytt schema har fått följande nya fält</li>
         <ul>
             <li>Beskrivning av schemat</li>
            <li>"Namn i schema" (för den som skapar schemat)</li>
         </ul>
      </ul>
   </div>  
    <br>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #ca7300;  padding: 10px;">
      <h2>För Schemaadministratörer</h2>
   </div>
    <br>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #ca7300;  padding: 10px;">
      <h2>För Användare</h2>
   </div>    
</div>
@endsection
