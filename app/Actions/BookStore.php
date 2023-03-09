<?php

namespace App\Actions;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookStore extends ActionBase
{

    public function execute($input)
    {
        $this->validate($input, [
            'title' => 'string|required',
            'genre' => 'string|required',
            'author' => 'string|required',
        ]);

        $user_id = Auth::user()->id;

        $book = Book::create([
            'user_id' => $user_id,
            'title' => $input['title'],
            'genre' => $input['genre'],
            'author' => $input['author']
        ]);

        return $book;
    }
}
