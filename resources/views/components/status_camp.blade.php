@switch($camp)
    @case('registered')
        <span class="bg-yellow p-2 rounded">Registriert</span>
        @break

    @case('confirmed')
        <span class="bg-green-light p-2 rounded">Bestätigt</span>
        @break

    @case('cancelled')
        <span class="bg-red p-2 rounded text-white">Abgesagt</span>
        @break

    @case('waiting')
        <span class="bg-orange-light p-2 rounded">Warteliste</span>
        @break

    @default
        Unbekannt
@endswitch