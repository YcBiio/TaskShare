@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md mx-auto bg-white rounded shadow p-8 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Vérification de l'email</h1>

        <p class="text-sm text-gray-600 mb-6">
            Un lien de vérification a été envoyé à votre adresse email.<br>
            Si vous ne l'avez pas reçu, vous pouvez en demander un nouveau.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600">
                Un nouveau lien de vérification a été envoyé à votre adresse email.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Renvoyer l'email de vérification
            </button>
        </form>

        <div class="mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:underline">Se déconnecter</button>
            </form>
        </div>
    </div>
@endsection
