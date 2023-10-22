<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class VoyageController extends Controller
{

    public function index2()
    {
        $voyages = Voyage::all();

        // Convertir les résultats en format JSON
        $voyagesJson = $voyages->toJson();

        // Passer les données à la vue
        return $voyagesJson;
    }

    public function index(Request $request)
    {
        $query = $request->get('search');

        $voyages = Voyage::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('date_voyage', 'like', "%$query%")
                ->orWhere('heure', 'like', "%$query%")
                ->orWhere('lieu_depart', 'like', "%$query%")
                ->orWhere('lieu_arrive', 'like', "%$query%");
        })
            ->paginate(10);



        return view('voyages.index', compact('voyages'));
    }

    public function create()
    {
        return view('voyages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_voyage' => 'required',
            'heure' => 'required',
            'nbr_places' => 'required',
            'lieu_depart' => 'required',
            'lieu_arrive' => 'required',
            'prix' => 'required',
            'telephone' => 'required',

        ]);

        $voyage = Voyage::create($request->all());
        $voyage->update(['user_id' => auth()->id()]);

        return redirect()->route('voyages.index')->with('success', 'Voyage created successfully.');
    }



    public function edit($id)
    {
        $voyage = Voyage::find($id);
        return view('voyages.edit', compact('voyage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_voyage' => 'required',
            'heure' => 'required',
            'nbr_places' => 'required|integer',
            'lieu_depart' => 'required',
            'lieu_arrive' => 'required',
        ]);

        $voyage = Voyage::find($id);
        $voyage->update($request->all());

        return redirect()->route('voyages.index')->with('success', 'Voyage updated successfully.');
    }

    public function destroy($id)
    {
        Voyage::find($id)->delete();
        return redirect()->route('voyages.index')->with('success', 'Voyage deleted successfully.');
    }

    public function show($id)
    {
        $voyage = Voyage::find($id);
        return view('voyages.show', compact('voyage'));
    }

}
