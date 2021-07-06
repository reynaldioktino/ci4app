<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Books extends BaseController
{
    protected $booksModel;
    public function __construct()
    {
        $this->booksModel = new BooksModel();
    }

    public function index()
    {
        $books = $this->booksModel->findAll();
        $data = [
            'title' =>  'Books',
            'books' =>  $books
        ];

        return view('books/index', $data);
    }
}
