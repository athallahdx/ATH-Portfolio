<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Inertia\Response;

class WorkController extends Controller
{
    public function index(): Response
    {
        $hasActivePortfolios = Portfolio::query()
            ->where('is_active', true)
            ->exists();

        $portfolios = Portfolio::query()
            ->with([
                'images',
                'type',
                'tags',
            ])
            ->where('is_active', true)
            ->whereRelation('type', 'name', 'work')
            ->latest()
            ->paginate(9);

        return inertia('Work', [
            'portfolios' => $portfolios,
            'hasActivePortfolios' => $hasActivePortfolios,
        ]);
    }

    public function show(Portfolio $portfolio): Response
    {
        $portfolio->load([
            'images',
            'tags',
        ]);

        $related = Portfolio::query()
            ->with(['images', 'tags'])
            ->where('is_active', true)
            ->where('type_id', $portfolio->type_id)
            ->where('id', '!=', $portfolio->id)
            ->take(3)
            ->get();

        return inertia('WorkDetail', [
            'portfolio' => $portfolio,
            'related' => $related,
        ]);
    }
}
