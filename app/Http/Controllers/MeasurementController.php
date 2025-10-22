<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Show form untuk edit/buat measurement
     */
    public function edit()
    {
        $measurement = auth()->user()->measurement ?? new Measurement();
        
        return view('measurements.edit', compact('measurement'));
    }

    /**
     * Store/Update measurement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chest' => 'nullable|numeric|min:0',
            'waist' => 'nullable|numeric|min:0',
            'hips' => 'nullable|numeric|min:0',
            'shoulder' => 'nullable|numeric|min:0',
            'sleeve_length' => 'nullable|numeric|min:0',
            'dress_length' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $measurement = auth()->user()->measurement ?? new Measurement();
        $measurement->user_id = auth()->id();
        $measurement->fill($validated);
        $measurement->save();

        return redirect()->route('measurement.edit')
            ->with('success', 'Data ukuran berhasil disimpan');
    }
}