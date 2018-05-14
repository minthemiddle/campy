@extends('layouts.app')

@section('content')
    <div class="mb-4"><h2>Alle Camps</h2>
        <p class="text-sm">Alle Camps anzeigen, aktuell auch noch jene, für die ich schon angemeldet bin.</p>
    </div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Stadt</th>
      <th scope="col">Von</th>
      <th scope="col">Bis</th>
      <th scope="col">Status</th>
      <th scope="col">TN sorted</th>
{{--       <th scope="col">Laptops</th>
 --}}    </tr>
  </thead>
  <tbody>
    @foreach ($camps as $camp)
    <tr>
      <td class="font-bold">{{ $camp->city }}</th>
      <td>{{ $camp->from }}</td>
      <td>{{ $camp->to }}</td>
      <td>{{ $camp->freeSpots }}</td>
      <td>
        <table>
          <thead>
            <tr>
              <th scope="col">Firstname</th>
              <th scope="col">Lastname</th>
              <th scope="col">Contribution</th>
              <th scope="col">Laptop</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($camp->users as $user)
            <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->laptop }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </td>
{{--       <td>{{ $laptops }}</td>
 --}}    </tr>
    @endforeach
  </tbody>
</table>
@endsection
