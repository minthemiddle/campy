@extends('layouts.app')

@section('content')

<div class="ml-4 mb-4">
<h2>Camp Anmeldung ändern</h2>

@isset($camp)
{{ $camp->city }}, {{ $camp->from->format('d.m.Y') }} bis {{ $camp->to->format('d.m.Y') }}, {{$camp->shortcode }}
@endisset

<div>Mein Campstatus:

@switch($camp->pivot->status)
    @case('registered')
        <span class="bg-yellow p-1 rounded text-xs">Registriert</span>
        @break

    @case('confirmed')
        <span class="bg-green-light p-1 rounded text-xs">Bestätigt</span>
        @break

    @case('cancelled')
        <span class="bg-red p-1 rounded text-xs text-white">Abgesagt</span>
        @break

    @case('waiting')
        <span class="bg-orange-light p-1 rounded text-xs">Warteliste</span>
        @break

    @default
        Unbekannt
@endswitch
</div>

</div>

@if ($errors->any())
<div class="bg-yellow rounded-lg p-4">
    Bitte alle Boxen markieren und Felder richtig ausfüllen.
</div>
@endif

<form action="/mycamps/{{ $camp->id }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="bg-grey-lighter shadow p-4 rounded lg:w-2/3">
        <p class="font-bold mb-4">Diese Daten von dir kennen wir schon…</p>
        <div class="flex">
          <div class="w-1/2">
            <label for="firstname">Vorname</label><br>
            <input name="firstname" class="p-2 w-full mt-2" type="text" value="{{ $user->firstname }}">
          </div>
          <div class="w-1/2 pl-2">
            <label for="lastname">Nachname</label><br>
            <input name="lastname" class="p-2 w-full mt-2" type="text" value="{{ $user->lastname }}" readonly>
          </div>
        </div>
        <div>
        <div class="flex mt-4"><div class="w-1/2">
                    <label for="birthdate">Geburtstag</label><br>
                    <input name="birthdate" class="p-2 w-full mt-2" type="date" value="{{ $user->birthdate->format('Y-m-d') }}" readonly>
                  </div>
                
                <div class="w-1/2 pl-2">
                    <label for="birthdate">Ernährung</label><br>
                    <input name="diet" class="p-2 w-full pb-4 mt-2" type="text" value="{{ $user->diet }}" readonly>
                  </div>
                </div>
          </div>
        <p class="mt-4">Fehler entdeckt? Bitte <a href="/home" target="_blank">hier</a> korrigieren!</p>
    </div>

    <h3 class="mt-8">Anmelde-Daten</h3>
    <label for="contribution">Campbeitrag</label><br>
    <select name="contribution" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                <option value="payer" @if($camp->pivot->contribution == 'payer')selected @endif>Ich zahle 75€ Unkostenbeitrag</option>
                <option value="waiver" @if($camp->pivot->contribution == 'waiver')selected @endif>Ich kann den Unkostenbeitrag gerade nicht zahlen</option>
            </select>
    
    <label for="laptop">Laptop</label><br>
    <select name="laptop" class="mt-2 block appearance-none w-full bg-white border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                <option value="own" @if ($camp->pivot->laptop == 'own') selected @endif>Nein, ich nutze eigenen Laptop</option>
                <option value="payer" @if ($camp->pivot->laptop == 'payer' or $camp->pivot->laptop == 'paid') selected @endif>Ja, ich überweise 75€ Unkostenbeitrag</option>
                <option value="waiver" @if ($camp->pivot->laptop == 'waiver') selected @endif>Ja, aber ich kann den Unkostenbeitrag nicht zahlen</option>
                
            </select>

    <input type="hidden" name="camp" value="{{ $camp->id }}">
    <input type="hidden" name="user" value="{{ $user->id }}">
    <div>@{{ message }}<input type="checkbox" name="cancel" class="mt-8"> <span class="text-red">Ich muss leider absagen, weil…</span><br>
        <textarea name="reason_for_cancellation" id="" rows="10" class="w-full mt-2 p-2"></textarea></div>
    <input type="submit" value="Ändern/Absagen" class="mt-4 bg-blue p-2 text-white shadow">
</form>

      </div>



@endsection
@section('scripts')
<script>
    var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!'
  }
})
</script>
</script>
@endsection