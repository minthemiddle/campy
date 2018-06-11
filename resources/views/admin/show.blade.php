@extends('layouts.app')

@section('content')
    <div class="mb-4"><h2>Alle Camps</h2>

<!-- Start: Dashboard -->
    <div class="flex flex-wrap">
      @foreach ($camps->sortBy('from') as $camp)
  <div class="p-4 bg-white rounded-lg ml-2">
    <div class="text-lg font-bold text-left mb-2">{{ $camp->city }} <span class="text-sm font-light tracking-wide ml-2">{{ $camp->shortcode }}</span></div>
  <table class="overflow-auto">
    <thead>
        <tr>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive"><line x1="22" y1="12" x2="2" y2="12"></line><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path><line x1="6" y1="16" x2="6" y2="16"></line><line x1="10" y1="16" x2="10" y2="16"></line></svg>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-2 border border-black border-2">{{ $camp->totalParticipants }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->freeSpots }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->totalGirls }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->totalLaptops }}</td>
        </tr>
    </tbody>
</table>
    </div> 
    @endforeach
    </div>

<!-- End: Dashboard -->

{{-- Start: Latest --}}
<h3 class="mt-4">Letzte Anmeldungen</h3>

<div>
  @foreach ($last as $l)
<div class="flex lg:w-1/2 mt-2 bg-white p-2">
  <div class="flex-1 ">{{ $l->user->firstname }}</div>
  <div class="flex-1">{{ $l->user->lastname }}</div>
  <div class="flex-1">{{ $l->camp->shortcode }}</div>
  <div class="flex-1 italic">{{ $l->created_at->diffForHumans() }}</div>
</div>
@endforeach
</div>{{-- End: Latest --}}

    <table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">Stadt</th>
      <th scope="col">Von</th>
      <th scope="col">Bis</th>
      <th scope="col">Noch frei</th>
      <th scope="col">Teilnehmer</th>
{{--       <th scope="col">Laptops</th>
 --}}    </tr>
  </thead>
  <tbody>
    @foreach ($camps->sortBy('from') as $camp)
    <tr>
      <td class="font-bold">{{ $camp->city }}</th>
      <td>{{ $camp->from->format('d.m.y') }}</td>
      <td>{{ $camp->to->format('d.m.y') }}</td>
      <td>{{ $camp->freeSpots }}</td>
      <td>
        <table class="overflow-x-auto">
          <thead>
            <tr>
              <th scope="col">Firstname</th>
              <th scope="col">Lastname</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Laptop</th>
              <th scope="col">Beitrag</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($camp->users as $user)
            <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td><a href="mailto:{{ $user->email }}?subject=Code+Design%20{{ $camp->city }}&body=Hallo%20{{ $user->firstname }}">{{ $user->email }}</a></td>
            <td>{{ $user->pivot->status }}</td>
            <td>{{ $user->pivot->laptop }}</td>
            <td>{{ $user->pivot->contribution }}</td>
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
