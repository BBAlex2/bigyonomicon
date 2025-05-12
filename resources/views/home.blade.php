@extends('layouts.app')

@section('content')
<div class="w-full bg-dark flex flex-col justify-content-center">
    <div class="row mt-2 p-5">
        <div class="col-6">
            <p class="fs-2 font-large clr-yellow">Európa & Eurázsia piacvezető házirelikvia forgalmazója</p>
            <p class="fs-5 clr-light">Szenvedélyünk a múlt megőrzése – webáruházunkban gondosan válogatott, egyedi házirelikviákat kínálunk, melyek történetet mesélnek. Legyen szó családi örökségről, nosztalgikus lakáskiegészítőről vagy ritkaságnak számító tárgyakról, nálunk megtalálod a különlegeset. Több ezer elégedett vásárlóval és folyamatosan bővülő kínálattal vezetjük a piacot Európában és Eurázsiában.</p>
        </div>
        <div class="col-6">
            <img src="{{ asset("img/eurasia.png")}}" alt="Eurázsia" class="img inline-block">
        </div>
    </div>
    <div class="row mt-2 p-5">
        <div class="col-4">
            <img src="{{ asset("img/logo.png")}}" alt="Logó" class="img inline-block homeLogo">
        </div>
        <div class="col-8">
            <p class="fs-2 font-large clr-yellow">Üdvözlünk az interaktív webshop jövőjében!</p>
            <p class="fs-5 clr-light">Webáruházunk nemcsak a vásárlást teszi kényelmessé, hanem minden termékről részletes, hiteles információt nyújt – legyen szó technikai adatokról, összetevőkről vagy háttértudásról. Emellett, ha megszakad az internetkapcsolatod, egy saját fejlesztésű játék gondoskodik a szórakozásodról. Nálunk a vásárlás nemcsak praktikus, hanem élmény is!</p>
        </div>
    </div>
</div>
@endsection
