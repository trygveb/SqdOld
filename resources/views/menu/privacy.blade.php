@extends('home/abctrav_layout')
@section('navbar')
@include('navbars.mainNavbar',[])
@endsection
@section('content')

<div class="abc-content">

    <h1>Användarvillkor</h1>
    Inga bilder, texter eller sammanställd information, eller utdrag därav, får användas för kommersiellt bruk eller i övrigt i strid mot reglerna
    i lag (1060:729) om upphovsrätt till litterära och konstnärliga verk.
    Samtliga rättigheter för travdata tillhör ATG och Svensk Travsport.
    <h1>@lang('Privacy policy')</h1>
    <strong>1. Insamling av information<br/>
    </strong>Vi samlar in information från dig när du registrerar dig på vår webbplats och när du skickar in kontaktformuläret.
    Den insamlade informationen inkluderar ditt namn och din e-postadress, och för kontaktformuläret också ditt meddelande.
    <p>Om du utnyttjar rankning, systemkonstruktion och provtippning, kan information om detta lagras i vår databas.</p>
    <p>Dessutom tar vi automatiskt emot och sparar viss information från din dator och webbläsare, inklusive din IP-adress,
        uppgifter om programvara och hårdvara och den begärda sidan. Denna information kopplas dock inte till dina registreringsuppgifter-</p>
    <h3></h3>
    <strong>2. Användning av information<br/></strong>
    Den information vi samlar in från dig kan användas för att:
    <ul>
        <li>Göra din upplevelse personlig och tillgodose dina personliga behov</li>
        <li>Förbättra vår hemsida</li>
        <li>Förbättra vår kundservice och ditt behov av hjälp</li>
        <li>Kontakta dig via e-post</li>
    </ul>
    <strong>3. Lagring av rankningsdata med IndexedDB <br/></strong>
    För att snabba upp visningen av beräknade rankningsdata kan eventuellt lagringssystemet IndexedDB komma att användas om din webbläsare stödjer detta.
    Datat lagras i så fall på din dator (eller telefon/surfplatta). Se <a href="https://developers.google.com/web/ilt/pwa/working-with-indexeddb">denna länk</a>
    för mer information.
 <h3></h3>
    <strong>4. Utlämnande till tredje part<br/></strong>
    Vi säljer, handlar, eller på annat sätt överför, inte personligt identifierbar information till utomstående parter.
    Detta inkluderar inte betrodd tredjepart som hjälper oss att driva vår webbplats,
    med kravet att dessa parter godkänner att hålla informationen konfidentiell.<br/>
    Vi anser att det är nödvändigt att dela information endast i syfte att undersöka, förhindra eller vidta åtgärder mot illegala aktiviteter, 
    misstänkt bedrägeri, situationer som medför en potentiell risk för en persons fysiska säkerhet,
    brott mot våra användarvillkor eller andra tillfällen då lagen så kräver.<br/>
    <h3></h3>
    <strong>5. Informationsskydd<br/></strong>
    Vi vidtar en rad olika säkerhetsåtgärder för att skydda dina personliga uppgifter. 
    Vi använder oss av avancerade krypteringsmetoder för att skydda känsliga uppgifter som överförs över internet.
    Endast medarbetare som ska uträtta ett specifikt jobb (t.ex. fakturering eller kundservice),
    får tillgång till personligt identifierbar information.
    De datorer/servrar som används för att lagra personligt identifierbar information lagras i en säker miljö.<br/><br/>
    <strong>6. Cookies/Kakor<br/></strong>
    Vi använder oss av cookies för att förbättrar tillgången till vår webbplats och identifierar återkommande besökare.
    Användningen kopplas inte till personligt identifierbar information på vår webbplats.<br/>
    <h3></h3>
    <strong>7. Samtycke<br/></strong>
    Genom att använda vår webbplats godkänner du vår integritetspolicy.


</div>

</section> <!-- end bricks -->

@endsection
