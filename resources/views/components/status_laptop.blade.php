@switch($laptop)
    @case('own')
        <p class="-mt-2 bg-grey-light p-2 rounded">Registriert</p>
        @break

    @case('payer')
        <p class="-mt-2 bg-grey-light p-2 rounded">Leihlaptop (Gebühr)</p>
        @break

    @case('waiver')
        <p class="-mt-2 bg-grey-light p-2 rounded">Leihlaptop (kostenlos)</p>
        @break

    @case('win')
        <p class="-mt-2 bg-grey-light p-2 rounded">Leihlaptop (kostenlos)</p>
        @break

    @case('paid')
        <p class="-mt-2 bg-green-light p-2 rounded">Leihlaptop Bezahlt!</p>
        @break

    @default
        Unbekannt
@endswitch