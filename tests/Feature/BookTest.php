<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;

class BookTest extends TestCase
{
    use RefreshDatabase;


    public function test_create_book(): void
    {
        $user = User::factory()->create();

        $book = Book::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'user_id' => $user->id,
            'title' => $book->title,
            'genre' => $book->genre,
            'author' => $book->author,
        ]);
    }

    public function test_create_book_route(): void
    {
        $user = User::factory()->createOne();

        $this->actingAs($user)->post(route('book.add'), [
            'title' => 'Titulo do livro',
            'genre' => 'Genero literario',
            'author' => 'Autor'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Titulo do livro',
            'genre' => 'Genero literario',
            'author' => 'Autor'
        ]);
    }

    public function test_book_update_route(): void
    {
        $user = User::factory()->createOne();

        $book = $this->actingAs($user)->post(route('book.add'), [
            'title' => 'Titulo do livro',
            'genre' => 'Genero literario',
            'author' => 'Autor'
        ]);

        $this->actingAs($user)->put(route('book.update', $book['id']), [
            'title' => 'Titulo do livro alterado',
            'genre' => 'Genero literario alterado',
            'author' => 'Autor alterado'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'Titulo do livro alterado',
            'genre' => 'Genero literario alterado',
            'author' => 'Autor alterado'
        ]);
    }

    public function test_show_book_route(): void
    {
        $user = User::factory()->createOne();

        $book = $this->actingAs($user)->post(route('book.add'), [
            'title' => 'Titulo do livro',
            'genre' => 'Genero literario',
            'author' => 'Autor'
        ]);

        $response = $this->actingAs($user)->get(route('book.show', $book['id']))
            ->assertOk();
    }

    public function test_delete_book_route(): void
    {
        $user = User::factory()->createOne();

        $book = $this->actingAs($user)->post(route('book.add'), [
            'title' => 'Titulo do livro',
            'genre' => 'Genero literario',
            'author' => 'Autor'
        ]);

        $this->actingAs($user)->delete(route('book.delete', $book['id']));

        $this->assertDatabaseCount('books', 0);
    }
}
