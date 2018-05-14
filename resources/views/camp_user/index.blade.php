@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="mb-4"><h2>Meine Camps</h2>
        <p class="text-sm">Nur die Camps anzeigen, für die ich registriert bin.</p>
    </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Stadt</th>
      <th scope="col">Von</th>
      <th scope="col">Bis</th>
      <th scope="col">Status</th>
      <th scope="col">Laptop?</th>
      <th scope="col">Optionen</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($camp_user as $camp)
    <tr>
      <td class="font-bold"><a href="mycamps/{{ $camp->id }}">{{ $camp->city }}</a></th>
      <td>{{ $camp->from->format('d.m.Y') }}</td>
      <td>{{ $camp->to->format('d.m.Y') }}</td>
      <td>{{ $camp->pivot->status }}</td>
      <td>{{ $camp->pivot->laptop }}</td>
      <td><a href="mycamps/{{ $camp->id }}/edit">Ändern/Absagen</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>
@endsection