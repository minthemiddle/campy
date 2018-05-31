@extends('layouts.app')

@section('content')
    <div class="mb-4"><h2>Alle Camps</h2>
      @if ($user->complete == '0') <div class="rounded-lg bg-yellow p-3 mb-4 mt-2">Profil fertigstellen: Bevor du dich für ein Camp anmelden kannst, musst du <a href="/home">hier</a> dein Profil vervollstätigen.</div>@endif
        <p class="text-sm">Alle Camps anzeigen, aktuell auch noch jene, für die ich schon angemeldet bin.</p>
    </div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Stadt</th>
      <th scope="col">Von</th>
      <th scope="col">Bis</th>
      <th scope="col">Status</th>
      <th scope="col">Optionen</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($camps as $camp)
    <tr>
      <td class="font-bold">{{ $camp->city }}</th>
      <td>{{ $camp->from->format('d.m.Y') }}</td>
      <td>{{ $camp->to->format('d.m.Y') }}</td>
      <td><span class="rounded p-2 @if ( $camp->status == 'Warteliste' ) bg-yellow @else bg-green text-white @endif">{{ $camp->status }}</span></td>
      <td>@if ($user->complete == '1')<a href="mycamps/create/{{ $camp->id  }}">Anmelden</a>@else <a href="/home">Profil vervollständigen</a>@endif</td>
    </tr>

    @endforeach
  </tbody>
</table>
@endsection
