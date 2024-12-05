<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularBooks = Book::withCount('rentItems')
            ->orderBy('rent_items_count', 'desc')
            ->take(10)
            ->get();

        return view('frontend.home', [
            'books' => Book::latest()->paginate(12),
            'popularBooks' => $popularBooks,
        ]);
    }
}