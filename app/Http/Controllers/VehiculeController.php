<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class VehiculeController extends Controller
{
    
   

    public function index(Request $request)
    {
      
       $search = $request->input('search');
        $user = auth()->user();
        $vehicules = Vehicule::where('chauffeur', $user->id);
    
        if ($search) {
            $vehicules->where('model', 'like', '%' . $search . '%');
        }
    
        $vehicules = $vehicules->paginate(2); // 4 items per page
    
        return view('vehicules.list', compact('vehicules'));
    }

    
    public function create()
    {
        return view('vehicules.create');
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'model' => 'required|max:255',
            'type' => 'required',
            'capacity' => 'required',
            'price' => 'required|numeric',
            'plateNumber' => ['required', 'regex:/^\d+TU\d+$/'],


        ]);

            // Log the user ID
    $user = auth()->user();
    $chauffeur =  $user->id ;

    // Associate the chauffeur with the vehicule
    $validatedData['chauffeur'] = $chauffeur;

        Vehicule::create($validatedData);

        return redirect()->route('vehicules.index')
            ->with('success', 'Vehicule created successfully.');
    }

    
    public function show($id)
    {
       

         // Retrieve the complaint using the given $id only if it belongs to the authenticated user.
         $vehicule = auth()->user()->vehicules      ->find($id);
    
         if (!$vehicule) {
             // Complaint doesn't exist or doesn't belong to the user.
             return abort(404);
         }
     
         return view('vehicules.show', compact('vehicule'));
    }

   
    public function edit($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.edit', compact('vehicule'));
    }

  
    public function update(Request $request,$id)
    {
        $vehicule = Vehicule::findOrFail($id);

        $validatedData = $request->validate([
            'price' => 'required|integer',
            
        ]);

        $vehicule->update($validatedData);

        return redirect()->route('vehicules.index')
            ->with('success', 'vehicule updated successfully.');
    }

    public function destroy($id)
    {
        $vehicule = Vehicule::findOrFail($id);


       

        $vehicule->delete();

        return redirect()->route('vehicules.index')
            ->with('success', 'vehicule deleted successfully.');
    }
    
}
