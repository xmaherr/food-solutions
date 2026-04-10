<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultation::with('service')->orderBy('created_at', 'desc');
        if ($request->has('filter') && $request->filter == 'unread') {
            $query->where('is_read', false);
        }
        $consultations = $query->get();
        return view('admin.consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
    {
        if (!$consultation->is_read) {
            $consultation->update(['is_read' => true]);
        }
        return view('admin.consultations.show', compact('consultation'));
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('admin.consultations.index')->with('success', 'Consultation deleted successfully.');
    }
}
