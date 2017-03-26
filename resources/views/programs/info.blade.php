@extends('layouts.layout')
@section('title', 'Új program')
@section('subtitle', 'Információ')
@section('icon', 'info-circle')
@section('content')
    @include('layouts.title')
    <p>
        Új program felvételéhez <b>Körvezető</b>nek vagy <b>PR mendezser</b>nek kell, hogy legyél az adott körnél <a href="https://korok.sch.bme.hu" target="_blank">VIR</a>-en.
    </p>

    <h4>Hogyan lehet valaki <b>PR menedzser</b>?</h4>
    <div class="alert alert-info" role="alert">A következő lépéseket csak a <b>Körvezető</b> és/vagy <b>delegált tag</b> tudja végrehajtani!</div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1. lépés
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>Jelentkezzünk be <a href="https://korok.sch.bme.hu" target="_blank">VIR</a>-be és navigáljunk a tagok adminisztrációs odalára.</p>
                    <p>Keressük ki a felhasználót és kattitsunk a <i>módosítás</i> linkre a <i>Jogok</i> oszlopban.</p>
                    <a href="{{ asset('images/pr_menedzser_how_to_1.png') }}" target="_blank">
                        <img src="{{ asset('images/pr_menedzser_how_to_1.png') }}" class="img-responsive img-thumbnail center-block">
                    </a>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2. lépés
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <p>Pipáljuk ki a <i>PR menedzser</i>-t és kattitsunk az <i>OK</i> gombra.</p>
                    <a href="{{ asset('images/pr_menedzser_how_to_2.png') }}" target="_blank">
                        <img src="{{ asset('images/pr_menedzser_how_to_2.png') }}" class="img-responsive img-thumbnail center-block">
                    </a>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3. lépés
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <p>Ha minden sikeresen ment, akkor megjelent a <i>Betöltött posztok</i> oszlopban a <i>PR menedzser</i> titulus.</p>
                    <p>Ha a felhasználó belépett a <a href="{{ route('index') }}>">Program.sch</a> oldalra és ha az <a href="https://auth.sch.bme.hu/" target="_blank">Auth.sch</a> is leszinkronizált a <a href="https://korok.sch.bme.hu" target="_blank">VIR</a>-el, akkor a felhasználó képes lesz programokat hozzáadni a naptárba.</p>
                    <a href="{{ asset('images/pr_menedzser_how_to_1.png') }}" target="_blank">
                        <img src="{{ asset('images/pr_menedzser_how_to_3.png') }}" class="img-responsive img-thumbnail center-block">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection