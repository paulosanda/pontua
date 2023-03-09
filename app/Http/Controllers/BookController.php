<?php

namespace App\Http\Controllers;

use App\Actions\BookDelete;
use App\Actions\BookStore;
use App\Actions\BookUpdate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user_id = Auth::user()->id;

        $books = Book::where('user_id', $user_id)->get();

        return response()->json($books, 200);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $book = app(BookStore::class)->execute([
            'title' => $request->title,
            'genre' => $request->genre,
            'author' => $request->author,
        ]);

        return response()->json($book, 200);
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $book = app(BookUpdate::class)->execute([
            'id' => $id,
            'title' => $request->title,
            'genre' => $request->genre,
            'author' => $request->author,
        ]);

        return response()->json($book['message'], $book['status']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    /**
     * show
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $book = Book::find($id);

        return response()->json($book, 200);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $response = app(BookDelete::class)->execute($id);

        return response()->json($response['message'], $response['status']);
    }
}
