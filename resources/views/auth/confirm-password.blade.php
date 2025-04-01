@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md mx-auto bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Confirmation requise</h1>

        <p class="text-sm text-gray-600 mb-4 text-center">
            Cette action nécessite la confirmation de votre mot de passe.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Confirmer
            </button>

            <div class="mt-4 text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
@endsection
