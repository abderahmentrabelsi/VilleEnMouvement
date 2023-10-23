<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Services\CountryService;
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


        ], [
            'model.required' => 'The model field is required.',
            'model.max' => 'The model may not be greater than :max characters.',
            'type.required' => 'The type field is required.',
            'capacity.required' => 'The capacity field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'plateNumber.required' => 'The plate number field is required.',
            'plateNumber.regex' => 'The plate number must be in the format: 123TU456.',
        ]);
        $string = app('profanityFilter')->replaceWith('#')->replaceFullWords(false)->filter($validatedData['model']);
        $validatedData['model'] = $string;

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
       

       //
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

    public function showCountries()
    {
        $countryService = new CountryService();
        $countries = $countryService->getCountries();

        return view('vehicules.countries', compact('countries'));
    }
    
}