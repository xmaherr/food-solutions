<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistic;

class StatisticController extends Controller
{
    public function index()
    {
        $statistic = Statistic::first();
        return view('admin.statistics.index', compact('statistic'));
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $data = $request->validate([
            'years_of_experience' => 'required|integer|min:0',
            'clients_count' => 'required|integer|min:0',
            'projects_count' => 'required|integer|min:0',
        ]);

        $statistic->update($data);
        return redirect()->route('admin.statistics.index')->with('success', 'Statistics updated successfully.');
    }
}
