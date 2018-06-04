@switch($camp)
    @case('registered')
        <p class="-mt-2 bg-yellow p-2 rounded">Registriert</p>
        @break

    @case('confirmed')
        <p class="-mt-2 bg-green-light p-2 rounded">Bestätigt</p>
        @break

    @case('cancelled')
        <p class="-mt-2 bg-red p-2 rounded text-white">Abgesagt</p>
        @break

    @case('waiting')
        <p class="-mt-2 bg-orange-light p-2 rounded">Warteliste</p>
        @break

    @default
        Unbekannt
@endswitch