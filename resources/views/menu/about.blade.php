@extends('layouts.app')
@section('content')
<div class="container">
<div class=WordSection1>

<h1>Inledning</h1>

<p class=MsoNormal>SdSchema är en webbapplikation som är till för att medlemmar
i förväg ska kunna registrera närvaro på kurser eller liknande aktiviteter som
hålls regelbundet, oftast en gång per vecka. Behovet finns för aktiviteter om
kräver ett minimiantal personer närvarande för att aktiviteten ska kunna
genomföras, till exempel squaredans där man måste vara minst åtta personer.
{{__('The source code is open and available at')}} <a href="https://github.com/trygveb/Sqd">Github</a>.</p>

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