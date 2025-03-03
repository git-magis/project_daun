<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taman;

class TamanController extends Controller
{

    public function index()
    {
        // Fetch all data from the taman table
        $data = Taman::all();

        // Pass data to the view
        return view('admin.manage_taman', ['data' => $data]);  // Ensure 'data' is passed correctly
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


}
