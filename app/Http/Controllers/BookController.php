<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\AdminCheckTrait;

class BookController extends Controller
{
    use AdminCheckTrait;

    public function getAllBooks(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $books = Book::paginate($perPage);


        return response()->json([
        'status' => 'success',
        'data' => [
            'books' => $books->items(),
            'pagination' => [
                'total' => $books->total(),
                'count' => $books->count(),
                'per_page' => $books->perPage(),
                'page' => $books->currentPage(),
                'total_pages' => $books->lastPage(),
            ]
        ]
    ], 200);
    }

    
    public function getBookDetails($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $book
        ], 200);
    }

   
    public function createBooks(Request $request)
    {
        if ($response = $this->isAdmin()) return $response;

        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'genre'          => 'required|string|max:100',
            'published_year' => 'required|integer|max:' . date('Y'),
            'total_copies'   => 'required|integer|min:1',
        ]);

        try {
            $book = Book::create([
                'title'           => $validated['title'],
                'author'          => $validated['author'],
                'genre'           => $validated['genre'],
                'published_year'  => $validated['published_year'],
                'total_copies'    => $validated['total_copies'],
                'available_copies'=> $validated['total_copies'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create resource',
            ], 500);
        }
    }

   
    public function updateBooks(Request $request, $id)
    {
        if ($response = $this->isAdmin()) return $response;

        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found',
            ], 404);
        }

        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'author'         => 'sometimes|string|max:255',
            'genre'          => 'sometimes|string|max:100',
            'published_year' => 'sometimes|integer|max:' . date('Y'),
            'total_copies'   => 'sometimes|integer|min:1',

        ]);
        if (isset($validated['total_copies'])) {
        $newTotal = $validated['total_copies'];
        $oldTotal = $book->total_copies;

        if ($newTotal > $oldTotal) {
            $difference = $newTotal - $oldTotal;
            $book->available_copies += $difference;
        }

        $book->total_copies = $newTotal;
        unset($validated['total_copies']);
    }

        try {
            $book->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Book updated successfully',
                'data' => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update book',
            ], 500);
        }
    }

   
    public function deleteBook($id)
    {
        if ($response = $this->isAdmin()) return $response;


        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Book not found',
            ], 404);
        }

        try {
            $book->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Book deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete book',
            ], 500);
        }
    }
}



