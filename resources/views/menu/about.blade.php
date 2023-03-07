@extends('layouts.app')
@section('content')
<div class="container">
<div class=WordSection1>

<h1>{{__('About SdSchema')}}</h1>

<p class=MsoNormal>{{__('SdSchema is a web application for members to be able to register attendance in advance for activities that are held regularly, usually once a week')}}.
    <br>
    {{__('The need exists for activities that require a minimum number of people present for the activity to be carried out, for example square dancing where there must be at least eight people')}}.
    <br>
    {{__('The source code is open and available at')}} <a href="https://github.com/trygveb/Sqd">Github</a>.
</p>
{{__('To connect to a schedule, you first need to register, with email address and password')}}.
<br>
{{__('The schedule manager can then connect you to one or more schedules')}}.
<br>
{{__('Once registered, you will  be redirected directly to the schedule page when you log in, (if you are only connected to one schedule)')}}.
{{__('If you are connected to more than one schedule, you must first select (click on) which schedule you want to access')}}.
<br>
{{__('Once on the schedule page, you can register your presence at future activity events')}}.
<br>
{{__('If you are registered as a couple in the schedule, you can register whether no one, one or two people are coming')}}.
{{__('Otherwise, register Yes or No')}}.
<br>
{{__('The option Maybe is also included to indicate that you want to decide later')}}.
<br><br>
{{__('To create a schedule, you need to have sufficient authority')}}.
{{__('To obtain it, you must')}} <a href="{{route('contact')}}">{{__('contact the application manager')}}.</a>
<br>
{{__('This authority includes the possibility to')}}:
<br>
{{__('')}}
<br>
{{__('')}}
<br>
{{__('')}}
<br>
<br>
För att skapa ett schema behöver du ha administratörsbehörighet. För att erhålla det måste du 
<a href="{{route('contact')}}" >kontakta applikationsansvarig.</a>




<p> Som administratör kan duskapa nya scheman. Varje schema har ett
namn, en beskrivning och en (standard) veckodag och ett (standard) klockslag.</p>

<p>Administratören är alltid Schemaadministratör för de scheman
hen har skapat, och kan också lägga till eller ta bort andra
Schemaadministratörer.</p>

<h2>Schemaadministratör</h2>

<p class=MsoNormal>En Schemaadministratör kan </p>

<ul>
<li>Lägga till och ta bort datum för aktiviteten (aktivitetstillfällen)</li>
<li>Uppdatera kommentarsfältet på aktivitetsdatum</li>
<li>Lägga till och ta bort medlemmar</li>
<li>Ange om medlemmen representerar en eller två personer</li>
</ul>
<h2>Medlem</h2>

<p class=MsoNormal>En Medlem kan </p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>Visa schemat</p>

<p class=MsoListParagraphCxSpLast style='text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>Registrera sin egen närvaro på <u>framtida</u>
aktivitetstillfällen. En medelm som är registrerad som ett par kan ange 1,2,
Nej eller Kanske, övriga kan ange Ja, Nej eller Kanske.</p>

<p class=MsoNormal>&nbsp;</p>

</div>

    
   </div>
<!--</div>-->

@endsection
@section('scripts')

@endsection