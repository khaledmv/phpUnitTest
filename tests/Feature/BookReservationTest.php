<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{

  use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     * 
     */
    /** @test */
   public function a_book_can_be_added_to_the_library()
   {
     $this->withoutExceptionHandling();
      $response = $this->post('/books', [
        'title' => 'Cool book title',
        'author' => 'Khaled',
      ]);

      $response->assertOk();
      $this->assertCount(1, Book::all());

   }


   /** @test */

   public function a_book_title_is_require()
   {
    
    $response = $this->post('/books', [
      'title' => ' ',
      'author' => 'Khaled',
    ]);

    $response->assertSessionHasErrors('title');
   }


   /** @test */

   public function a_book_author_is_require()
   {
    
    $response = $this->post('/books', [
      'title' => 'A cool name',
      'author' => ' ',
    ]);

    $response->assertSessionHasErrors('author');
   }


    /** @test */

    public function a_book_can_be_updated()
    {
      $this->withoutExceptionHandling();

     $this->post('/books', [
       'title' => 'A cool name',
       'author' => ' Victor',
     ]);

     $book = Book::first();
     $response = $this->patch('/books/' . $book->id, [
       'title' => 'New cool name',
       'author' => ' New cool author',
     ]);
 
     $this->assertEquals('New cool name', Book::first()->title);
     $this->assertEquals('New cool author', Book::first()->author);
    }


}
