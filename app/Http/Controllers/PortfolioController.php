<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(Request $request): Response
    {
        $hasActivePortfolios = Portfolio::query()
            ->where('is_active', true)
            ->exists();

        $portfolios = Portfolio::query()
            ->with([
                'images',
                'type',
                'tags',
                'techstacks',
            ])
            ->where('is_active', true)
            ->whereRelation('type', 'name', 'project')
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($query) use ($request) {
                    $query->where('name', $request->tag);
                });
            })
            ->when($request->filled('techstack'), function ($query) use ($request) {
                $query->whereHas('techstacks', function ($query) use ($request) {
                    $query->where('name', $request->techstack);
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return inertia('Portfolio', [
            'portfolios' => $portfolios,
            'hasActivePortfolios' => $hasActivePortfolios,
            'filters' => $request->only(['tag', 'techstack']),
        ]);
    }

    public function show(Portfolio $portfolio): Response
    {
        $portfolio->load([
            'images',
            'type',
            'tags',
            'techstacks',
        ]);

        $related = Portfolio::query()
            ->with(['images', 'type', 'techstacks'])
            ->where('is_active', true)
            ->where('type_id', $portfolio->type_id)
            ->where('id', '!=', $portfolio->id)
            ->take(3)
            ->get();

        return inertia('PortfolioDetail', [
            'portfolio' => $portfolio,
            'related' => $related,
        ]);
    }
}
