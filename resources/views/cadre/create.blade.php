@extends('cadre.layout')
@section('main')

    <h2>Crcréer une fichier</h2>

    <form method="POST" action="{{ route('fichiers.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="objet">Objet:</label>
        <input type="text" id="objet" name="objet" required>
        <br>

        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" required>
        <br>

        <label for="destinateurt">Destinateur:</label>
        <input type="text" id="destinateurt" name="destinateurt" required>
        <br>

        <label for="destinataire">Destinataire:</label>
        <input type="text" id="destinataire" name="destinataire" required>
        <br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>

        <label for="division_id">Division ID:</label>
        <input type="text" id="division_id" name="division_id" required>
        <br>

        <label for="categorie_id">Categorie ID:</label>
        <input type="text" id="categorie_id" name="categorie_id" required>
        <br>

        <label for="fichier">Fichier (PDF):</label>
        <input type="file" id="fichier" name="fichier" accept=".pdf" required>
        <br>

        <button type="submit">Create Fichier</button>
    </form>



@endsection
