<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;

use App\Models\Division;
use App\Models\Fichier;
use Illuminate\Support\Facades\Auth;


class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
        if (Auth::check() && Auth::user()->role === 'chef') {
             $user = Auth::user(); // Retrieve authenticated user
             $userDivisionId = $user->division_id; // Get authenticated user's division ID

             $divisions = Division::all();
             $categories = Categorie::all();
             $services = Service::all();

             // Fetch fichiers belonging to the authenticated user's division
             $fichiers = Fichier::where('archiver', false)
                             ->whereHas('division', function ($query) use ($userDivisionId) {
                                 $query->where('id', $userDivisionId);
                             })
                             ->paginate(10);

             return view('chef.home', compact('fichiers', 'divisions', 'categories', 'services'));
         } else {
            return redirect('/');
         }
     }


    public function search(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'chef') {
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

        return view('chef.home', compact('fichiers', 'categories', 'divisions'));
    }else{
        return redirect()->back();
    }
    }

    public function filteredByCategory($categoryId)
{
    if (Auth::check() && Auth::user()->role === 'chef') {
    $user = Auth::user();
    $userDivisionId = $user->division_id;
    $categories = Categorie::all();
    $category = Categorie::findOrFail($categoryId);

    // Fetch fichiers belonging to the authenticated user's division and the selected category
    $fichiers = Fichier::where('archiver', false)
        ->where('categorie_id', $categoryId)
        ->whereHas('division', function ($query) use ($userDivisionId) {
            $query->where('id', $userDivisionId);
        })
        ->paginate(10);

    return view('chef.home', compact('fichiers', 'categories'));
}else{
    return redirect()->back();
}
}










}
