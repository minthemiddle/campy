@extends('layouts.app')

@section('content')
<div class="md:flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
                Login
            </div>
            <div class="bg-white p-3 rounded-b">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="md:flex items-stretch mb-3">
                        <label for="username" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Username</label>
                        <div class="md:flex md:flex-col md:w-3/4">
                            <input id="username" type="text" class="w-full md:flex-grow h-8 px-2 border rounded {{ $errors->has('username') ? 'border-red-dark' : 'border-grey-light' }}" name="username" value="{{ old('username') }}" required autofocus>
                            {!! $errors->first('username', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="md:flex items-stretch mb-4">
                        <label for="password" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Password</label>
                        <div class="md:flex md:flex-col md:w-3/4">
                            <input id="password" type="password" class="w-full md:flex-grow h-8 px-2 rounded border {{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" name="password" required>
                            {!! $errors->first('password', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                        </div>
                    </div>

                    <div class="md:flex mb-4">
                        <label class="md:w-3/4 ml-auto">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="text-sm text-grey-dark"> Eingeloggt bleiben?</span>
                        </label>
                    </div>

                    <div class="md:flex">
                        <div class="md:w-3/4 md:ml-auto">
                            <button type="submit" class="bg-brand hover:bg-brand-dark text-white text-sm font-semibold py-2 px-4 rounded mr-3">
                                Login
                            </button>
                            <a class="no-underline hover:underline text-brand-dark text-sm" href="{{ route('password.request') }}">
                                Passwort vergessen?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
