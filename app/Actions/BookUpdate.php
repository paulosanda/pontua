<?php

namespace App\Actions;

use App\Models\Book;

class BookUpdate extends ActionBase
{

    /**
     * execute
     *
     * @param  mixed $input
     * @return array
     */
    public function execute($input): array
    {
        $this->validate($input, [
            'title' => 'string|required',
            'genre' => 'string|required',
            'author' => 'string|required',
        ]);

        $book = Book::where('id', '=', $input['id'])->update([
            'title' => $input['title'],
            'genre' => $input['genre'],
            'author' => $input['author']
        ]);


        if ($book) {
            $response = [
                'status' => 200,
                'message' => 'Livro alterado com sucesso'
            ];
        } else {
            $response = [
                'status' => 500,
                'message' => 'Erro ao alterar o livro, verifique se o id esta correto'
            ];
        }

        return $response;
    }
}
