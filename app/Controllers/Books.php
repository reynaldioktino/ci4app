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
        //$books = $this->booksModel->findAll();
        $data = [
            'title' =>  'Books',
            'books' =>  $this->booksModel->getBooks()
        ];

        return view('books/index', $data);
    }

    public function add()
    {
        $data = [
            'title' =>  'Form Add Book'
        ];

        return view('books/add', $data);
    }

    public function insert()
    {
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->booksModel->save([
            'title' =>  $this->request->getVar('title'),
            'slug' =>  $slug,
            'writer' =>  $this->request->getVar('writer'),
            'publiser' =>  $this->request->getVar('publiser'),
            'cover' =>  $this->request->getVar('cover'),
        ]);

        session()->setFlashdata('message', 'Insert Data Success!');

        return redirect()->to('/books');
    }

    public function detail($slug)
    {
        // $book = $this->booksModel->where(['slug' => $slug])->first();
        //dd($this->booksModel->getBooks($slug));
        $data = [
            'title' =>  'Books Detail',
            'book' =>  $this->booksModel->getBooks($slug)
        ];

        if (empty($data['book'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku ' . $slug . ' tidak ditemukan.');
        }

        return view('books/detail', $data);
    }
}
