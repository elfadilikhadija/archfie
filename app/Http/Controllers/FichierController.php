<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Division;
use App\Models\Fichier;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichiers = Fichier::paginate(10);
        return view ('cadre.home' , ['fichiers' => $fichiers] );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::all();
        $categories = Categorie::all();


         return view('cadre.create', ['categories' => $categories , 'divisions' => $divisions]);
    }

    
    public function store(Request $request)
    {
    $request->validate([
        'objet' => 'required',
        'numero' => 'required',
        'destinateurt' => 'required',
        'destinataire' => 'required',
        'date' => 'required',
        'division_id' => 'required',
        'categorie_id' => 'required',
        'fichier' => 'required|mimes:pdf|max:2048', // Validate
    ]);

    if ($request->hasFile('fichier')) {
        $file = $request->file('fichier');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/pdfs', $fileName);

        Fichier::create([
            'objet' => $request->objet,
            'numero' => $request->numero,
            'destinateurt' => $request->destinateurt,
            'destinataire' => $request->destinataire,
            'date' => $request->date,
            'division_id' => $request->division_id,
            'categorie_id' => $request->categorie_id,
            'fichier' => 'public/pdfs/' . $fileName, // Save relative path
        ]);

        return redirect()->route('cadre.home')
            ->with('success', 'File uploaded successfully.');
    }




    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
