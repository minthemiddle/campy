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
              <div>To</div>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <div>Fr</div>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <div>R</div>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <div>Co</div>
            </td>
            <td class="p-2 border border-black border-2 bg-grey-lighter">
              <div>La</div>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-2 border border-black border-2">{{ $camp->max }}</td><td class="p-2 border border-black border-2">{{ $camp->freeSpots }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->RegisteredParticipants }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->ConfirmedParticipants }}</td>
            <td class="p-2 border border-black border-2">{{ $camp->orderedlaptops }}</td>
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
              <th scope="col" class="p-2">ID</th>
              <th scope="col" class="p-2">Firstname</th>
              <th scope="col" class="p-2">Lastname</th>
              <th scope="col" class="p-2">Email</th>
              <th scope="col" class="p-2">Status</th>
              <th scope="col" class="p-2">Laptop</th>
              <th scope="col" class="p-2">Beitrag</th>
              <th scope="col" class="p-2">Anmeldung</th>
              <th scope="col" class="p-2">💰</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($camp->users->sortBy('firstname') as $user)
            <tr class="bg-white">
              <td class="p-2">{{ $user->id }}</td>
            <td class="p-2 bg-grey-lighter">{{ $user->firstname }}</td>
            <td class="p-2">{{ $user->lastname }}</td>
            <td class="p-2 bg-grey-lighter"><a href="mailto:{{ $user->email }}?subject=Code+Design%20{{ $camp->city }}&body=Hallo%20{{ $user->firstname }}">{{ $user->email }}</a></td>
            <td class="p-2">{{ $user->pivot->status }}</td>
            <td class="p-2 bg-grey-lighter">{{ $user->pivot->laptop }}</td>
            <td class="p-2">{{ $user->pivot->contribution }}</td>
            <td class="p-2 bg-grey-lighter italic">{{ $user->pivot->created_at->diffForHumans() }}</td>
            <td class="p-2">@if ($user->pivot->status == 'registered')<a class="text-sm no-underline" href="/admin/campuser/confirm/{{ $camp->id }}/{{ $user->id }}">☑️</a>@endif</td>

            </tr>
            @endforeach
          </tbody>
        </table>

    @endforeach
  </tbody>
</table>
@endsection
