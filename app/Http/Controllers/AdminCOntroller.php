<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Fichier;
use App\Models\Service;
use App\Models\Categorie;
class AdminController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        $categories = Categorie::all();

        $fichiers = Fichier::where('archiver', false)->paginate(10);

        return view('admine.home', compact('fichiers','divisions', 'categories'));
    }
    public function listAcc()
{
    $services = Service::all();
    $users = User::all();
    return view('admine.acounts', compact('users', 'services'));
}
public function edit($id)
{
    $fichier = Fichier::findOrFail($id);
    $divisions = Division::all();
    $services = Service::all();
    $categories = Categorie::all();

    return view('admine.edite', compact('fichier', 'divisions', 'services', 'categories'));
}


    public function archife()
    {
        $divisions = Division::all();
        $categories = Categorie::all();

        $fichiers = Fichier::where('archiver', true)->paginate(10);

        return view('admine.archive', compact('fichiers','divisions', 'categories'));
    }


    public function create()
    {
        $divisions = Division::all();
        $categories = Categorie::all();
        $services = Service::all();

        return view('admine.create', compact('categories', 'services', 'divisions'));
    }


    public function store(Request $request)
    {
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
                'service_id' => $request->service_id,
                'division_id' => $request->division_id,
                'categorie_id' => $request->categorie_id,
                'fichier' =>  $fileName,
            ]);

            return redirect()->route('admine.home')
                ->with('success', 'File uploaded successfully.');
        }
     }




    public function search(Request $request)
    {
        $categories = Categorie::all();
        $service = Service::all();
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

        return view('admine.home', compact('fichiers', 'services', 'categories', 'divisions'));
    }



        public function update(Request $request, $id)
        {
            $request->validate([
                'objet' => 'required',
                'numero' => 'required',
                'destinateurt' => 'required',
                'destinataire' => 'required',
                'date' => 'required',
                'service_id' => 'required',
                'division_id' => 'required',
                'categorie_id' => 'required',
                'fichier' => 'nullable|mimes:pdf|max:2048',
            ]);

            $fichier = Fichier::findOrFail($id);

            $fichier->update([
                'objet' => $request->objet,
                'numero' => $request->numero,
                'destinateurt' => $request->destinateurt,
                'destinateurt' => $request->destinateurt,
                'service_id' => $request->service_id,
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

            return redirect()->route('admin.home')->with('success', 'File updated successfully.');
        }
        public function destroy($id)
        {
            $fichier = Fichier::findOrFail($id);

            $fichier->archiver = true;
            $fichier->save();

            return redirect()->route('admin.home')->with('success', 'File archived successfully.');
        }
        public function desarchifier($id)
        {
            $fichier = Fichier::findOrFail($id);

            if ($fichier->archiver) {
                $fichier->archiver = false;
                $fichier->save();
                return redirect()->route('admin.home')->with('success', 'File unarchived successfully.');
            } else {
                // If the file was not archived, you may want to handle this case differently
                return redirect()->route('admin.home')->with('error', 'File is not archived.');
            }
        }
        public function filteredByService(Request $request, $serviceId)
        {
            $services = Service::all();
            $divisions = Division::all();

            $fichiers = Fichier::where('archiver', false)
                ->where('service_id', $serviceId)
                ->paginate(10);

            return view('admine.home', compact('fichiers', 'services', 'divisions'));
        }


        public function filteredByCategory(Request $request, $categoryId)
        {
            $categories = Categorie::all();
            $divisions = Division::all();

            $fichiers = Fichier::where('archiver', false)
                ->where('categorie_id', $categoryId)
                ->paginate(10);

            return view('admine.home', compact('fichiers', 'categories', 'divisions'));
        }



    public function filteredByDivision(Request $request, $division)
    {
        $divisions = Division::all();
        $categories = Categorie::All();
        $fichiers = Fichier::where('division_id', $division)->paginate(10);
        return view('admine.home', ['fichiers' => $fichiers , 'categories'=>$categories , 'divisions'=>$divisions ]);
    }


}
