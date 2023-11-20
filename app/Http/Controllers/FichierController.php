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
        $divisions = Division::all();
        $categories = Categorie::all();

        $fichiers = Fichier::where('archiver', false)->paginate(10);

        return view('cadre.home', compact('fichiers','divisions', 'categories'));
    }

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
                'fichier' =>  $fileName,
            ]);

            return redirect()->route('cadre.home')
                ->with('success', 'File uploaded successfully.');
        }
     }

        public function edit($id)
    {
        $fichier = Fichier::findOrFail($id);
        $divisions = Division::all();
        $categories = Categorie::all();

        return view('cadre.update', compact('fichier', 'divisions', 'categories'));
    }

        public function search(Request $request)
    {
        $query = $request->input('query');

        $fichiers = Fichier::where('objet', 'like', '%' . $query . '%')
                            ->orWhere('numero', 'like', '%' . $query . '%')
                            ->orWhere('destinateurt', 'like', '%' . $query . '%')
                            ->orWhere('destinataire', 'like', '%' . $query . '%')
                            ->orWhere('date', 'like', '%' . $query . '%')
                            ->paginate(10);

        return view('cadre.home', ['fichiers' => $fichiers]);
    }


     public function update(Request $request, $id)
    {
        $request->validate([
            'objet' => 'required',
            'numero' => 'required',
            'destinateurt' => 'required',
            'destinataire' => 'required',
            'date' => 'required',
            'division_id' => 'required',
            'categorie_id' => 'required',
            'fichier' => 'nullable|mimes:pdf|max:2048',
        ]);

        $fichier = Fichier::findOrFail($id);

        $fichier->update([
            'objet' => $request->objet,
            'numero' => $request->numero,
            'destinateurt' => $request->destinateurt,
            'destinataire' => $request->destinataire,
            'date' => $request->date,
            'division_id' => $request->division_id,
            'categorie_id' => $request->categorie_id,
        ]);

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pdfs', $fileName);

            $fichier->update(['fichier' => $fileName]);
        }

        return redirect()->route('cadre.home')->with('success', 'File updated successfully.');
    }
        public function destroy($id)
        {
            $fichier = Fichier::findOrFail($id);

            $fichier->archiver = true;
            $fichier->save();

            return redirect()->route('cadre.home')->with('success', 'File archived successfully.');
        }

        public function filteredByCategory(Request $request, $categoryId)
        {
            $fichiers = Fichier::where('categorie_id', $categoryId)->paginate(10);
            return view('cadre.home', ['fichiers' => $fichiers]);
        }


    public function filteredByDivision(Request $request, $division)
    {

        $fichiers = Fichier::where('division_id', $division)->paginate(10);


        return view('cadre.home', ['fichiers' => $fichiers]);
    }


}
