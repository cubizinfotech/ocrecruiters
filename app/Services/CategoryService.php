<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryService
{

    public function filter(Request $request)
    {
        Log::info('Applying category filters', $request->all());

        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;
            Log::debug('Filtering category with search term', ['search' => $search]);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc');
    }
}