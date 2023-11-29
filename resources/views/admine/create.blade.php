@extends('admine.layout')
@section('main')
    <div class="container">
        <h2 class="text-center">Créer un fichier</h2>
        <form method="POST" class="border p-5" action="{{ route('fichiers.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="objet" class="form-label">Objet:</label>
                <input type="text" class="form-control" id="objet" name="objet" required>
            </div>

            <div class="mb-3">
                <label for="numero" class="form-label">Numero:</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>

            <div class="mb-3">
                <label for="destinateurt" class="form-label">Destinateur:</label>
                <input type="text" class="form-control" id="destinateurt" name="destinateurt" required>
            </div>

            <div class="mb-3">
                <label for="destinataire" class="form-label">Destinataire:</label>
                <input type="text" class="form-control" id="destinataire" name="destinataire" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="mb-3">
                <label for="division_id" class="form-label">Division:</label>
                <select class="form-select" id="division_id" name="division_id" required>
                    <option value="" disabled selected>Select Division</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label">Service:</label>
                <select class="form-select" id="service_id" name="service_id" required>
                    <option value="" disabled selected>Select service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->nom }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="categorie_id" class="form-label">Categorie:</label>
                <select class="form-select" id="categorie_id" name="categorie_id" required>
                    <option value="" disabled selected>Select Categorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier (PDF):</label>
                <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Fichier</button>
        </form>
    </div>
@endsection
