<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Services\FileService;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private FileService $fileService
    ) {}

    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $data = Book::query();

        if ($search) {
            $data->where('title', 'like', '%' . $search . '%');
        }

        if ($category) {
            $data->whereHas('bookCategories', function ($query) use ($category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            });
        }

        $data = $data->latest()->paginate(10);

        return view('backend.buku.index', [
            'data' => $data,
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('backend.buku.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $this->fileService->upload($request->file('cover'), 'covers');
        }

        $book = Book::create($data);

        foreach ($request->category as $category) {
            BookCategory::create([
                'book_id' => $book->id,
                'category_id' => $category
            ]);
        }


        return redirect()->route('panel.books.index')->with('success', 'Buku <b>' . $request->get('title') . '</b> berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        return view('backend.buku.show', [
            'book' => $book
        ]);
    }

    public function edit(Book $book)
    {
        return view('backend.buku.edit', [
            'book' => $book,
            'categories' => Category::all()
        ]);
    }

    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                $this->fileService->delete(public_path('storage/' . $book->cover));
            }
            $data['cover'] = $this->fileService->upload($request->file('cover'), 'covers');
        }

        $book->update($data);

        BookCategory::where('book_id', $book->id)->delete();

        foreach ($request->category as $category) {
            BookCategory::create([
                'book_id' => $book->id,
                'category_id' => $category
            ]);
        }

        return redirect()->route('panel.books.index')->with('success', 'Buku <b>' . $request->get('title') . '</b> berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        if ($book->cover) {
            $this->fileService->delete(public_path('storage/' . $book->cover));
        }

        $book->delete();

        return redirect()->back()->with('success', 'Buku <b>' . $book->title . '</b> berhasil dihapus');
    }
}