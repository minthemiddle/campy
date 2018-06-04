@switch($laptop)
    @case('own')
        <span class="bg-grey-light p-2 rounded">Registriert</span>
        @break

    @case('payer')
        <span class="bg-grey-light p-2 rounded">Leihlaptop (Gebühr)</span>
        @break

    @case('waiver')
        <span class="bg-grey-light p-2 rounded text-white">Leihlaptop (kostenlos)</span>
        @break

    @case('win')
        <span class="bg-grey-light p-2 rounded">Leihlaptop (kostenlos)</span>
        @break

    @case('paid')
        <span class="bg-green-light p-2 rounded">Leihlaptop Bezahlt!</span>
        @break

    @default
        Unbekannt
@endswitch