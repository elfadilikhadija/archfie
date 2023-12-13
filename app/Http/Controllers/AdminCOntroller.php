<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Division;
use App\Models\Fichier;
use App\Models\Service;
use App\Models\Categorie;
class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $divisions = Division::all();
            $categories = Categorie::all();
            $fichiers = Fichier::where('archiver', false)->paginate(5);
            return view('admine.home', compact('fichiers','divisions', 'categories'));
        }else{
            return redirect()->back();
        }
    }
    public function listAcc()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // i safaa add
            $divisions = Division::all();
            // i safaa add
            $services = Service::all();
            $users = User::all();
            return view('admine.acounts', compact('users', 'services','divisions'));
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $fichier = Fichier::findOrFail($id);
            $divisions = Division::all();
            $services = Service::all();
            $categories = Categorie::all();

            return view('admine.edite', compact('fichier', 'divisions', 'services', 'categories'));
        }else{
            return redirect()->back();
        }
    }


    public function archife()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $divisions = Division::all();
            $categories = Categorie::all();
            $fichiers = Fichier::where('archiver', true)->paginate(10);
            return view('admine.archive', compact('fichiers','divisions', 'categories'));
        }else{
           return redirect()->back();
        }
    }


    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $divisions = Division::all();
            $categories = Categorie::all();
            $services = Service::all();
            return view('admine.create', compact('categories', 'services', 'divisions'));
        }else{
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
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

                return redirect()->route('admin.home')
                    ->with([
                        'success' => 'File uploaded successfully'
                    ]);;
            }
        }else{
            return redirect()->back();
        }
    }



    public function search(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $categories = Categorie::all();
            $services = Service::all();
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
        }else{
            return redirect()->back();
        }
    }



        public function update(Request $request, $id)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {

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
            }else{
                return redirect()->back();
            }
        }
        public function destroy($id)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
                $fichier = Fichier::findOrFail($id);
                $fichier->archiver = true;
                $fichier->save();
                return redirect()->route('admin.home')->with('success', 'File archived successfully.');
            }else{
                return redirect()->back();
            }
        }
        public function desarchifier($id)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
                $fichier = Fichier::findOrFail($id);
                if ($fichier->archiver) {
                    $fichier->archiver = false;
                    $fichier->save();
                    return redirect()->route('admin.home')->with('success', 'File unarchived successfully.');
                } else {
                    return redirect()->route('admin.home')->with('error', 'File is not archived.');
                }
            }else{
                return redirect()->back();
            }
        }


        public function filteredByService(Request $request, $serviceId)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
                $services = Service::all();
                $divisions = Division::all();
                $fichiers = Fichier::where('archiver', false)
                    ->where('service_id', $serviceId)
                    ->paginate(10);
                return view('admine.home', compact('fichiers', 'services', 'divisions'));
            }else{
                return redirect()->back();
            }
        }


        public function filteredByCategory(Request $request, $categoryId)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
                $categories = Categorie::all();
                $divisions = Division::all();
                $fichiers = Fichier::where('archiver', false)
                    ->where('categorie_id', $categoryId)
                    ->paginate(10);
                return view('admine.home', compact('fichiers', 'categories', 'divisions'));
            }else{
                return redirect()->back();
            }
        }
        public function filteredByDivision(Request $request, $division)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
            $divisions = Division::all();
            $categories = Categorie::All();
            $fichiers = Fichier::where('division_id', $division)->paginate(10);
            return view('admine.home', ['fichiers' => $fichiers , 'categories'=>$categories , 'divisions'=>$divisions ]);
            }else{
                return redirect()->back();
            }
        }
        public function searchByName(Request $request)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
            $searchTerm = $request->input('search');
            $users = User::where('name', 'LIKE', "%$searchTerm%")->get();
            $divisions = Division::all(); // You need to retrieve divisions to pass them to the view

            return view('admine.acounts', ['users' => $users, 'divisions' => $divisions]);
        }else{
            return redirect()->back();
        }
        }

        public function showModifyForm($id)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            $divisions = Division::all();

            return view('admine.modify', compact('user', 'divisions'));
        }else{
            return redirect()->back();
        }
        }

        public function modify(Request $request, $id)
        {

            if (Auth::check() && Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'division_id' => 'required|exists:divisions,id',
                'role' => 'required|in:cadre,sg,admin,chef',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $user->name = $request->input('name');
            $user->division_id = $request->input('division_id');
            $user->role = $request->input('role');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            return redirect()->route('admine.accounts')->with('success', 'User information updated successfully.');
        }else{
            return redirect()->back();
        }
        }

        public function deleteUser($id)
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admine.accounts')->with('success', 'User deleted successfully.');
        }else{
            return redirect()->back();
        }
        }




}
