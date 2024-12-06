<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $books = Book::query();

        if ($search) {
            $books->where('title', 'like', '%' . $search . '%');
        }

        if ($category) {
            $books->whereHas('bookCategories', function ($query) use ($category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            });
        }

        $books = $books->latest()->paginate(18);

        return view('frontend.books', [
            'books' => $books,
            'categories' => Category::all()
        ]);
    }

    public function show(string $book)
    {
        $book = Book::where('slug', $book)->firstOrFail();

        return view('frontend.book-detail', [
            'book' => $book,
            'relatedBooks' => Book::where('id', '!=', $book->id)->whereHas('bookCategories', function ($query) use ($book) {
                $query->whereHas('category', function ($query) use ($book) {
                    $query->whereIn('id', function ($query) use ($book) {
                        $query->select('category_id')->from('book_categories')->where('book_id', $book->id);
                    });
                });
            })->latest()->paginate(6)
        ]);
    }
}
