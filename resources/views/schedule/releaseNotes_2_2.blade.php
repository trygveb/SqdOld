@extends('schedule.layout')

@section('content')


<div class="container">
    <h1 class="text-center"> {{ __('Release notes')}} for {{$names['application']}}  Version 2.2 </h1>
    <br>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #ca7300;  padding: 10px;">
      <h2>För Schemaadministratörer</h2>
      <ul>
          <li>Länken till sidan för att skapa nytt schema ligger numera under menyn med ditt namn</li>
          <li>Den sidan har fått följande nya fält</li>
         <ul>
             <li>Beskrivning (av schemat)</li>
            <li>"Namn_i_schema"</li>
         </ul>
          <li>På sidan "Mina scheman" kan du nu ändra namn och andra attribut för scheman som du administrerar</li>
          <li>Diverse hjälptexter inlagda</li>
      </ul>
   </div>
    <br>
     <div style="margin-left:auto;margin-right:auto;  width: 60%;  border: 3px solid #ca7300;  padding: 10px;">
      <h2>För alla Användare</h2>
         <ul>
             <li>Fylligare information under menyvalet "Om"</li>
             <li>Sidan "Mina scheman" har fått lite mer information</li>
         </ul>
   </div>    
</div>
@endsection
