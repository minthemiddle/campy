@extends('layouts.app')

@section('content')

<div class="ml-8 "><h2 class="text-blue-darker">Deine Daten</h2>
<p>Bitte verfolgständige deine Daten. Nur mit vollständigen Daten kannst du dich bei einem Camp anmelden.</p></div>

@if ($errors->any())
<div class="bg-yellow rounded-lg p-4">
    Bitte alle Boxen markieren und Felder richtig ausfüllen.
</div>
@endif

@if(Session::has('info'))
<div class="bg-yellow rounded-lg p-4">
    {{ Session::get('info') }}
</div>
@endif
                <form action="/users/{{ $user->id }}" method="POST">
                  <input type="hidden" name="_method" value="PATCH">
                  {{ csrf_field() }}
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
  <div class="-mx-3 md:flex md:mb-6">
    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
        Vorname(n)
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 mb-3" id="grid-first-name" type="text" name="firstname" placeholder="Grace" value="{{ $user->firstname or old('firstname') }}">
    </div>
    <div class="md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
        Nachname
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" name="lastname" placeholder="Hopper" value="{{ $user->lastname or old('lastname') }}">
    </div>
    <div class="md:w-1/2 px-3 mb-6 md:mb-0 mt-4 md:mt-0">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
        Geburtstag
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="date" name="birthdate" value="{{ $user->birthFormatted or old('birthdate') }}">
    </div>
  </div>
  <div class="-mx-3 md:flex mb-2">
    <div class="flex-1"></div>
<div class="md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="mobile">
        Handynummer
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="mobile" type="tel" pattern="^[0-9-+s()]*$" name="mobile" value="{{ $user->mobile or old('mobile') }}" placeholder="0172-12345678">
    </div>
    
    <div class="md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
        Ernährung
      </label>
      <div class="relative">
        <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state" name="diet">
          @foreach ($diets as $diet)
          <option value="{{ $diet }}" {{ $selected_diet == $diet ? 'selected="selected"' : '' }}>{{ $diet }}</option>
          {{ $diet }}
          @endforeach
        </select>
        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
    </div>
    <div class="mt-4 md:mt-0 md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
        PLZ
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" name="zip" id="grid-zip" type="text" value="{{ $user->zip or old('zip') }}">
    </div>

  </div>
  <h3 class="mt-4 mb-2 text-grey-dark">Freiwillige Angaben</h3>
  <div class="-mx-3 md:flex mb-2">
    <div class="px-3 mb-6 md:mb-0 flex-1">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="Instagram">
        Instagram
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" name="instagram" placeholder="codeunddesign" value="{{ $user->instagram or old('instagram') }}">
    </div>
    <div class="px-3 mb-6 md:mb-0 flex-1">
      <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="twitter">
        Twitter
      </label>
      <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" name="twitter"  placeholder="@codeunddesign" pattern="^@[A-Za-z0-9_]{1,32}$" value="{{ $user->twitter or old('twitter') }}">
    </div>
    
  </div>
  <input type="submit" class="mt-8 bg-blue-lighter p-3 rounded text-blue-darkest" value="Speichern" name="submit">
</div>

                </form>

@endsection
