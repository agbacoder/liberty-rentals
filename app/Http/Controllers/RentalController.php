<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function rentBook($book_id)
    {

        $user = Auth::user();
        $book = Book::find($book_id);

        if (!$book) {
        return response()->json([
            'status' => 'error',
            'message' => 'Book not found',
        ], 404);
        }

        if ($book->available_copies < 1) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Book is not available for rent.',
            ], 400);
        }

        $alreadyRented = Rental::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($alreadyRented) {
            return response()->json([
                'status'  => 'error',
                'message' => 'You have already rented this book and are yet to return it',
            ], 409);
        }

        try {
            $rental = Rental::create([
                'user_id'    => $user->id,
                'book_id'    => $book->id,
                'rented_at'  => now(),
            ]);

            $book->decrement('available_copies');

            return response()->json([
                'status'  => 'success',
                'message' => 'Book rented successfully.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' =>  $e->getMessage(),
            ], 500);
        }
    }

    public function returnBook($book_id)
    {
       $book = Book::find($book_id);
        if (!$book) {
        return response()->json([
            'status' => 'error',
            'message' => 'Book not found',
        ], 404);
        }

        $user = Auth::user();

        $rental = Rental::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if (!$rental) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No active rental found for this book.',
            ], 404);
        }

        try {
            $rental->update([
                'returned_at' => now()
            ]);

            $rental->book->increment('available_copies');

            return response()->json([
                'status'  => 'success',
                'message' => 'Book returned successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to return book.',
            ], 500);
        }
    }


}
