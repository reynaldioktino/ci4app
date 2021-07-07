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

    public function edit($slug)
    {
        $data = [
            'title' =>  'Edit Books',
            'book'  =>  $this->booksModel->getBooks($slug),
            'validation'    =>  \Config\Services::validation()
        ];

        return view('books/update', $data);
    }

    public function update()
    {
        $title = $this->request->getVar('title');
        $slug = $this->request->getVar('slug');

        $books = $this->booksModel->getBooks($slug);

        if ($title == $books['title']) {
            $validation_title = 'required';
        } else {
            $validation_title = 'required|is_unique[books.title]';
        }

        //input validation
        if (!$this->validate([
            'title' =>  [
                'rules' =>  $validation_title,
                'errors'    =>  [
                    'required'  =>  '{field} is required.',
                    'is_unique' =>  'Book title already use.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/books/edit/' . $books['slug'])->withInput()->with('validation', $validation);
        }

        $new_slug = url_title($title, '-', true);
        $id_books = $this->request->getVar('id_books');
        $book_data = [
            'title' =>  $title,
            'slug' =>  $new_slug,
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
