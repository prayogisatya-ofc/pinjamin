<?php

namespace App\Http\Controllers\Backend;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Backend\BookService;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');

        $data = Book::query();

        if ($search) {
            $data->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('cover', 'like', '%' . $search . '%')
                ->orWhere('stock', $search);
        }

        // Filter by category jika ada
        if ($categoryId) {
            $data->where('category_id', $categoryId);
        }

        $data = $data->latest()->paginate(10);

        // Ambil semua kategori untuk dropdown filter
        $categories = $this->bookService->getCategory();

        return view('backend.book.index', [
            'data' => $data,
            'categories' => $categories,
            'selectedCategory' => $categoryId
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.book.create', [
            'categories' => $this->bookService->getCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();

        $this->bookService->store($data);

        return redirect()->route('book.index')->with('success', 'Book  <b>' . $request->get('title') . '</b> created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->bookService->getFirstBy('id', $id);

        return view('backend.book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = $this->bookService->getFirstBy('id', $id);

        return view('backend.book.edit', [
            'book' => $book,
            'categories' => $this->bookService->getCategory()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();

        $this->bookService->update($book, $data);

        return redirect()->route('books.index')->with('success', 'Book  <b>' . $book->title . '</b> updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->bookService->delete($book);

        return redirect()->route('books.index')->with('success', 'Book <b>' . $book->title . '</b> deleted successfully!');
    }
}