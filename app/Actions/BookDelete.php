<?php

namespace App\Actions;

use App\Models\Book;

class BookDelete extends ActionBase
{

    public function execute($id)
    {
        $book = Book::where('id', $id)->delete();

        if ($book) {
            $response = [
                'status' => 200,
                'message' => 'Livro deletado com sucesso'
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'O livro não pode ser deletado'
            ];
        }

        return $response;
    }
}
