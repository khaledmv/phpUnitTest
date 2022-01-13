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
}
