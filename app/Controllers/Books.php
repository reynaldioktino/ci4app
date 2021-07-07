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
            'title' =>  'Form Add Book',
            'validation'    =>  \Config\Services::validation()
        ];

        return view('books/add', $data);
    }

    public function insert()
    {
        //input validation
        if (!$this->validate([
            'title' =>  [
                'rules' =>  'required|is_unique[books.title]',
                'errors'    =>  [
                    'required'  =>  '{field} is required.',
                    'is_unique' =>  'Book title already use.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/books/add')->withInput()->with('validation', $validation);
        }

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

    public function edit($id_books)
    {
        $data = [
            'title' =>  'Edit Books',
            'book'  =>  $this->booksModel->getBooksId($id_books),
            'validation'    =>  \Config\Services::validation()
        ];

        return view('books/update', $data);
    }

    public function update()
    {
        $id_books = $this->request->getVar('id_books');
        $slug = url_title($this->request->getVar('title'), '-', true);
        $book_data = [
            'title' =>  $this->request->getVar('title'),
            'slug' =>  $slug,
            'writer' =>  $this->request->getVar('writer'),
            'publiser' =>  $this->request->getVar('publiser'),
            'cover' =>  $this->request->getVar('cover'),
        ];

        $this->booksModel->update($id_books, $book_data);

        session()->setFlashdata('message', 'Update Data Success!');

        return redirect()->to('/books');
    }

    public function delete($id_books)
    {
        $this->booksModel->delete($id_books);

        session()->setFlashdata('message', 'Delete Data Success!');

        return redirect()->to('/books');
    }
}
