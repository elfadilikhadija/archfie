<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Division;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = Categorie::all();
        $division = Division::all();


         return view('cadre.create', ['categorie' => $categorie , 'division' => $division]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        'fichier' => 'required|mimes:pdf|max:2048', // Validate PDF files only, max size 2MB
    ]);

    // Handle file upload
    if ($request->hasFile('fichier')) {
        $file = $request->file('fichier');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('pdfs', $fileName, 'public'); // Store in the 'pdfs' directory within the 'public' disk

        // Save the file name in the database
        $request->merge(['fichier' => $fileName]);
    }

    Fichier::create($request->all());

    return redirect()->route('fichiers.index')->with('success', 'Fichier created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
