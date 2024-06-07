<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::all();
        return view('admin.savings.savings', compact('savings'));
    }

    public function create()
    {
        return view('admin.savings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'goal' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Saving::create($data);

        return redirect()->route('admin.savings.index')->with('success', 'Oszczędność została dodana.');
    }

    public function edit($id)
    {
        $saving = Saving::findOrFail($id);
        return view('admin.savings.edit', compact('saving'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'goal' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $saving = Saving::findOrFail($id);
        $saving->update($request->all());

        return redirect()->route('admin.savings.index')->with('success', 'Oszczędność została zaktualizowana.');
    }

    public function destroy($id)
    {
        $saving = Saving::findOrFail($id);
        $saving->delete();

        return redirect()->route('admin.savings.index')->with('success', 'Oszczędność została usunięta.');
    }
}
