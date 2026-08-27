<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Expertise;
use App\Models\CurriculumVitae;
use App\Models\Contact;
use App\Models\Techstack;
use App\Models\AboutMe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        $expertises = Expertise::where('is_active', true)->get();

        $aboutme = AboutMe::all();

        $curriculumvitae = CurriculumVitae::where('is_active', true)->first();

        $techstacks = Techstack::where('is_active', true)->get();

        $contact = Contact::first();

        return inertia('Home', [
            'aboutme' => $aboutme,
            'curriculumvitae' => $curriculumvitae,
            'portfolios' => $portfolios,
            'expertises' => $expertises,
            'techstacks' => $techstacks,
            'contact' => $contact,
        ]);
    }
}
