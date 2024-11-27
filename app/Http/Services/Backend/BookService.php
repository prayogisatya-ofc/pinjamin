<?php

namespace App\Http\Services\Backend;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookService
{

    public function store(array $data): Book
    {
        // Upload cover jika ada
        if (isset($data['cover']) && $data['cover']->isValid()) {
            $data['cover'] = $data['cover']->store('covers', 'public');
        }

        // Buat record baru
        return Book::create($data);
    }


    public function update(Book $book, array $data): Book
    {
        // Hapus cover lama jika ada file baru
        if (isset($data['cover']) && $data['cover']->isValid()) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $data['cover']->store('covers', 'public');
        }

        // Update data
        $book->update($data);

        return $book;
    }


    public function delete(Book $book): bool
    {
        // Hapus cover jika ada
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        // Hapus data buku
        return $book->delete();
    }

    public function getCategory()
    {
        return Category::latest()->get(['id', 'name']);
    }

    public function getFirstBy(string $column, string $value)
    {
        return Book::where($column, $value)->first();
    }
}