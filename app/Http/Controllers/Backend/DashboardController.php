<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rent;
use App\Models\RentItem;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalRenter = User::where('role', 'renter')->count();
        $bookRenteds = Rent::whereNull('actual_return_date')->get()->sum(function ($rent) {
            return $rent->rentItems->count();
        });
        $lostBooks = RentItem::where('is_lost', true)->count();

        $data = Rent::latest()->take(5)->get();

        return view('backend.dashboard', [
            'totalBooks' => $totalBooks,
            'totalRenter' => $totalRenter,
            'bookRenteds' => $bookRenteds,
            'lostBooks' => $lostBooks,
            'data' => $data
        ]);
    }
}