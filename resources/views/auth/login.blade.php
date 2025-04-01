@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md mx-auto bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Connexion</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required autofocus
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded text-blue-600">
                    <span class="ml-2">Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Se connecter</button>

            <p class="mt-4 text-center text-sm text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">S'inscrire</a>
            </p>
        </form>
    </div>
@endsection
