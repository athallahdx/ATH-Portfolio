<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioType;
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
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->whereHas('type', function ($query) use ($request) {
                    $query->where('name', $request->type);
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $types = PortfolioType::where('is_active', true)->get();

        return inertia('Portfolio', [
            'portfolios' => $portfolios,
            'hasActivePortfolios' => $hasActivePortfolios,
            'types' => $types,
            'filters' => $request->only(['tag', 'techstack', 'type']),
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
