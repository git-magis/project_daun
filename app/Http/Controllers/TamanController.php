<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Taman;

class TamanController extends Controller
{

    public function index()
    {
        $data = Taman::all();

        // return view('admin.manage_taman', ['data' => $data]);
        return view('admin.manage_taman', compact('data')); 
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'kode' => 'required|string|max:10',
        ]);
    
        // Save the data to the database
        Taman::create($validated);
    
        // return redirect()->route('manage-taman')->with('success', 'Data saved successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data saved sucessfully.');
    }
    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'kode' => 'required|string|max:10',
        ]);
    
        // Find the Taman record by ID
        $data = Taman::findOrFail($id);
    
        // Update the data
        $data->update($validated);
    
        // return redirect()->route('manage-taman')->with('success', 'Data updated successfully.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data updated sucessfully.');
    }
    

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = Taman::findOrFail($id);
        $data->delete();

        // Redirect back with a success message
        // return redirect()->route('manage-taman')->with('success', 'taman berhasil dihapus.');
        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')
        ->with('success', 'Data deleted sucessfully.');
    }

    public function getTamans()
    {
        $tamans = Taman::withCount(['pohons', 'bungas'])->get();
        // $tamans = Taman::all();

        return response()->json($tamans);
    }

    public function showMap()
    {
        $taman = Taman::first();
        return view('admin.add_peta', compact('taman'));
    }

    public function editMap($id)
    {
        $taman = Taman::findOrFail($id);
        return view('admin.edit_peta', compact('taman'));
    }

    public function saveLocation(Request $request)
    {
        session([
            'selected_latitude' => $request->latitude,
            'selected_longitude' => $request->longitude
        ]);

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')->with('open_modal', true);
    }

    public function getTamanData($id)
    {
        $taman = Taman::find($id);

        if (!$taman) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json([
            'id' => $taman->id,
            'nama' => $taman->nama,
            'latitude' => $taman->latitude,
            'longitude' => $taman->longitude,
            'kode' => $taman->kode
        ]);
    }

    public function updateLocation(Request $request)
    {
        $taman = Taman::findOrFail($request->id);
        $taman->nama = $request->nama;
        $taman->kode = $request->kode;
        $taman->latitude = $request->latitude;
        $taman->longitude = $request->longitude;
        $taman->save();

        return redirect()->route(auth()->user()->level === 'admin' ? 'admin.manage-taman' : 'staff.manage-taman')->with('success', 'Taman updated successfully!');
    }

}
