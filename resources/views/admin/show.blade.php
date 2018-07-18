@extends('layouts.app')

@section('content')
    <div class="mb-4"><h2>Alle Camps</h2>

<!-- Start: Dashboard -->
    <div class="flex flex-wrap mt-4">
      @foreach ($camps->sortBy('from') as $camp)
  <div class="p-4 bg-white rounded-lg ml-2">
    <div class="text-lg font-bold text-left mb-2">{{ $camp->city }} <span class="text-sm font-light tracking-wide ml-2">{{ $camp->shortcode }} ({{ $camp->id }})</span></div>
    <div class="mb-2">
      {{ $camp->from->format('d.m.') }} – {{ $camp->to->format('d.m.y') }}
    </div>
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

    @foreach ($camps->sortBy('from') as $camp)

    <div class="text-xl mt-8 mb-2">{{ $camp->city }} <span class="text-md text-grey-dark">(<code>#{{ $camp->id }}</code>)</span></div>
    
    <table class="overflow-x-auto w-full">
          <thead>
            <tr class="bg-grey-light">
              <th scope="col" class="p-2">Firstname</th>
              <th scope="col" class="p-2">Lastname</th>
              <th scope="col" class="p-2">Email</th>
              <th scope="col" class="p-2">Status</th>
              <th scope="col" class="p-2">Laptop</th>
              <th scope="col" class="p-2">Beitrag</th>
              <th scope="col" class="p-2">Anmeldung</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($camp->users->sortBy('firstname') as $user)
            <tr class="bg-white">
            <td class="p-2 bg-grey-lighter">{{ $user->firstname }}</td>
            <td class="p-2">{{ $user->lastname }}</td>
            <td class="p-2 bg-grey-lighter"><a href="mailto:{{ $user->email }}?subject=Code+Design%20{{ $camp->city }}&body=Hallo%20{{ $user->firstname }}">{{ $user->email }}</a></td>
            <td class="p-2">{{ $user->pivot->status }}</td>
            <td class="p-2 bg-grey-lighter">{{ $user->pivot->laptop }}</td>
            <td class="p-2">{{ $user->pivot->contribution }}</td>
            <td class="p-2 bg-grey-lighter italic">{{ $user->pivot->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

    @endforeach
  </tbody>
</table>
@endsection
