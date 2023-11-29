<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Categorie;

use App\Models\Division;
use App\Models\Fichier;

class SgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::all();
        $categories = Categorie::all();

        $fichiers = Fichier::where('archiver', false)->paginate(10);

        return view('sg.home', compact('fichiers','divisions', 'categories'));
    }







    public function search(Request $request)
    {
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

        return view('sg.home', compact('fichiers', 'categories', 'divisions'));
    }






        public function filteredByCategory(Request $request, $categoryId)
        {
            $categories = Categorie::all();
            $divisions = Division::all();

            $fichiers = Fichier::where('archiver', false)
                ->where('categorie_id', $categoryId)
                ->paginate(10);

            return view('sg.home', compact('fichiers', 'categories', 'divisions'));
        }



    public function filteredByDivision(Request $request, $division)
    {
        $divisions = Division::all();
        $categories = Categorie::All();
        $fichiers = Fichier::where('division_id', $division)->paginate(10);
        return view('sg.home', ['fichiers' => $fichiers , 'categories'=>$categories , 'divisions'=>$divisions ]);
    }


}
