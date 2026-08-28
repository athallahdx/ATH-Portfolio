<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Inertia\Response;

class PortfoliotmpController extends Controller
{
    public function index(Request $request): Response
    {
        $portfolios = Portfolio::query()
        ->with([
            'thumbnail',
            'type',
            'tags',
            'techstacks',
        ])
        ->where('is_active', true)

        // Filter by tag
        ->when($request->filled('tag'), function ($query) use ($request) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('slug', $request->tag);
            });
        })

        // Filter by techstack
        ->when($request->filled('techstack'), function ($query) use ($request) {
            $query->whereHas('techstacks', function ($query) use ($request) {
                $query->where('slug', $request->techstack);
            });
        })

        // Filter by portfolio type
        ->when($request->filled('type'), function ($query) use ($request) {
            $query->whereHas('type', function ($query) use ($request) {
                $query->where('slug', $request->type);
            });
        })

        ->latest()
        ->paginate(9)
        ->withQueryString();

        return inertia('Portfolio', [
            'portfolios' => $portfolios,
        ]);
    }

    public function show(Portfolio $portfolio): Response
    {
        $portfolio->load([
            'thumbnail',
            'type',
            'tags',
            'techstacks',
        ]);

        return inertia('Portfolios/Show', [
            'portfolio' => $portfolio,
        ]);
    }
}
