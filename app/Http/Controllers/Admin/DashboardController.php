<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Contact;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
    {
        $totals = [
            'services' => Service::count(),
            'contacts' => Contact::where('type', 'contact')->count(),
            'socials' => Contact::where('type', 'social')->count(),
            'consultations' => Consultation::count(),
            'unread_consultations' => Consultation::where('is_read', false)->count()
        ];
        return view('admin.dashboard', compact('totals'));
    }
}
