<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;

use App\Models\Division;
use App\Models\Fichier;
use Illuminate\Support\Facades\Auth;

class CadreController extends Controller
{
    public function index()
    {

        // return view('cadre.home');
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $services = Service::all();
            $user = Auth::user(); // Retrieve authenticated user
            $userDivisionId = $user->division_id; // Get authenticated user's division ID

            $divisions = Division::all();
            $categories = Categorie::all();


            // Fetch fichiers belonging to the authenticated user's division
            $fichiers = Fichier::where('archiver', false)
                ->whereHas('division', function ($query) use ($userDivisionId) {
                    $query->where('id', $userDivisionId);
                })
                ->paginate(10);

            return view('cadre.home', compact('fichiers', 'divisions', 'categories', 'services'));
        } else {
            return redirect('/');
        }
    }









    public function search(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $services = Service::all();
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

            return view('cadre.home', compact('fichiers', 'categories', 'divisions','services'));
        } else {
            return redirect()->back();
        }
    }

    public function filteredByCategory($categoryId)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {

            $user = Auth::user();
            $userDivisionId = $user->division_id;
            $services = Service::all();
            $categories = Categorie::all();
            $category = Categorie::findOrFail($categoryId);
            $divisions = Division::all();
            // Fetch fichiers belonging to the authenticated user's division and the selected category
            $fichiers = Fichier::where('archiver', false)
                ->where('categorie_id', $categoryId)
                ->whereHas('division', function ($query) use ($userDivisionId) {
                    $query->where('id', $userDivisionId);
                })->paginate(10);

            return view('cadre.home', compact('fichiers', 'categories', 'divisions','services'));
        } else {
            return redirect()->back();
        }
    }




    public function filteredByDivision($division)
    {
        if (Auth::check() && Auth::user()->role === 'cadre') {
            $user = Auth::user();
            $services = Service::all();
            $divisions = Division::all();
            $categories = Categorie::all();
            $fichiers = Fichier::where('division_id', $division)->paginate(10);
            return view('cadre.home', ['fichiers' => $fichiers, 'categories' => $categories, 'divisions' => $divisions,'services'=>$services]);
        } else {
            return redirect()->back();
        }
    }
}
