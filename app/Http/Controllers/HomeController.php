<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Contact;
use App\Models\CurriculumVitae;
use App\Models\Expertise;
use App\Models\Portfolio;
use App\Models\Techstack;
use App\Models\Hero;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $portfolios = Portfolio::with(['techstacks', 'images', 'type'])
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        $expertises = Expertise::where('is_active', true)->get();

        $aboutme = AboutMe::all();

        $curriculumvitae = CurriculumVitae::where('is_active', true)->first();

        $techstacks = Techstack::where('is_active', true)->get();

        $contact = Contact::first();

        $hero = Hero::first();

        return inertia('Home', [
            'hero' => $hero,
            'aboutme' => $aboutme,
            'curriculumvitae' => $curriculumvitae,
            'portfolios' => $portfolios,
            'expertises' => $expertises,
            'techstacks' => $techstacks,
            'contact' => $contact,
        ]);
    }
}
