<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;

use App\Models\Division;
use App\Models\Fichier;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (Auth::check() && Auth::user()->role === 'cadre')
            {
                $divisions = Division::all();
                $categories = Categorie::all();
                $services = Service::all();

                $fichiers = Fichier::where('archiver', false)->paginate(10);

                return view('cadre.home', compact('fichiers','divisions', 'categories' , 'services'));
            }else{
                return redirect()->back();
            }
    }

    public function create()
    {
        if (Auth::check()  && Auth::user()->role === 'cadre')
        {
            $divisions = Division::all();
            $categories = Categorie::all();
            $services = Service::all();
            return view('cadre.create', ['services' => $services ,'categories' => $categories , 'divisions' => $divisions]);
        }else{
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $request->validate([
                'objet' => 'required',
                'numero' => 'required',
                'destinateurt' => 'required',
                'destinataire' => 'required',
                'date' => 'required',
                'service_id' => 'required',
                'division_id' => 'required',
                'categorie_id' => 'required',
                'fichier' => 'required|mimes:pdf|max:2048', // Validate
            ]);

            if ($request->hasFile('fichier'))
            {
                $file = $request->file('fichier');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/pdfs', $fileName);
                Fichier::create([
                    'objet' => $request->objet,
                    'numero' => $request->numero,
                    'destinateurt' => $request->destinateurt,
                    'destinataire' => $request->destinataire,
                    'date' => $request->date,
                    'service_id' => $request->service_id,
                    'division_id' => $request->division_id,
                    'categorie_id' => $request->categorie_id,
                    'fichier' =>  $fileName,
                ]);

                return redirect()->route('cadre.home')
                ->with('success', 'File uploaded successfully.');
            }
        }else{
            return redirect()->back();

        }
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role === 'cadre')
        {
            $fichier = Fichier::findOrFail($id);
            $divisions = Division::all();
            $categories = Categorie::all();
            return view('cadre.update', compact('fichier', 'divisions', 'categories'));
        }else{
            return redirect()->back();

        }
    }

    public function search(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $categories = Categorie::all();
            $divisions = Division::all();
            $query = $request->input('query');

            $fichiers = Fichier::where('archiver', false)
                ->where(function ($q) use ($query) {
                    $q->where('objet', 'like', '%' . $query . '%')
                        ->orWhere('numero', 'like', '%' . $query . '%')
                        ->orWhere('destinateurt', 'like', '%' . $query . '%')
                        ->orWhere('destinataire', 'like', '%' . $query . '%')
                        ->orWhere('date', 'like', '%' . $query . '%');
                })
                ->paginate(10);

            return view('cadre.home', compact('fichiers', 'categories', 'divisions'));
        }else{
            return redirect()->back();

        }
    }



    public function update(Request $request, $id)
    {
        if (Auth::check()&& Auth::user()->role === 'cadre') {
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
        } else {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $fichier = Fichier::findOrFail($id);

            $fichier->archiver = true;
            $fichier->save();

            return redirect()->route('cadre.home')->with('success', 'File archived successfully.');
        }else{
            return redirect()->back();
        }
    }

    public function filteredByCategory(Request $request, $categoryId)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $categories = Categorie::all();
            $divisions = Division::all();

            $fichiers = Fichier::where('archiver', false)
                ->where('categorie_id', $categoryId)
                ->paginate(10);
            return view('cadre.home', compact('fichiers', 'categories', 'divisions'));
        }else{
            return redirect()->back();
        }
    }



    public function filteredByDivision(Request $request, $division)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $divisions = Division::all();
            $categories = Categorie::All();
            $fichiers = Fichier::where('division_id', $division)->paginate(10);
            return view('cadre.home', ['fichiers' => $fichiers , 'categories'=>$categories , 'divisions'=>$divisions ]);
        }else{
            return redirect()->back();
        }
    }


}
