@extends('layouts.app')

@section('title', 'Créer une liste')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-6">Créer une nouvelle liste</h1>

        <form method="POST" action="{{ route('task-lists.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la liste</label>
                <input type="text" id="name" name="name" required
                       class="mt-1 block w-full border rounded p-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('task-lists.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded">Annuler</a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Créer</button>
            </div>
        </form>
    </div>
@endsection
