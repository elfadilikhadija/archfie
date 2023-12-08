@extends('admine.layout')
@section('content')
    <div class="container">
        <h2 class="text-center">Modifier le fichier</h2>
        <form method="POST" class="border p-5" action="{{ route('fichiers.update', ['id' => $fichier->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Use PATCH method for updating -->

            <div class="mb-3">
                <label for="objet" class="form-label">Objet:</label>
                <input type="text" class="form-control" id="objet" name="objet" value="{{ $fichier->objet }}" required>
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Numero:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ $fichier->numero }}" required>
            </div>

            <div class="mb-3">
                <label for="destinateurt" class="form-label">Destinateur:</label>
                <input type="text" class="form-control" id="destinateurt" name="destinateurt" value="{{ $fichier->destinateurt }}" required>
            </div>

            <div class="mb-3">
                <label for="destinataire" class="form-label">Destinataire:</label>
                <input type="text" class="form-control" id="destinataire" name="destinataire" value="{{ $fichier->destinataire }}" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $fichier->date }}" required>
            </div>

            <div class="mb-3">
                <label for="division_id" class="form-label">Division:</label>
                <select class="form-select" id="division_id" name="division_id" required>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" @if($division->id === $fichier->division_id) selected @endif>{{ $division->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="categorie_id" class="form-label">Categorie:</label>
                <select class="form-select" id="categorie_id" name="categorie_id" required>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" @if($categorie->id === $fichier->categorie_id) selected @endif>{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier (PDF):</label>
                <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf"> <!-- Update file input -->
            </div>

            <button type="submit" class="btn btn-primary">Update Fichier</button>
        </form>
    </div>
@endsection
