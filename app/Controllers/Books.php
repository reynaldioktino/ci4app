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
            ],
            'cover' =>  [
                //'rules' =>  'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover, image/jpg,image/jpeg,image/png]',
                'rules' =>  'max_size[cover,1024]|is_image[cover]|mime_in[cover, image/jpg,image/jpeg,image/png]',
                'errors'    =>  [
                    //'uploaded'  =>  'Choose image first.',
                    'max_size'  =>  'Your image is too big.',
                    'is_image'  =>  'Your file is not image.',
                    'mime_in'   =>  'Your file is not image.'
                ]
            ]
        ])) {
            //$validation = \Config\Services::validation();

            return redirect()->to('/books/add')->withInput();
        }

        //get cover
        $coverFile = $this->request->getFile('cover');

        if ($coverFile->getError() == 4) {
            $coverName = 'default.jpg';
        } else {
            //get cover file name (randomname)
            $coverName = $coverFile->getRandomName();

            //move cover to image folder
            $coverFile->move('image', $coverName);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->booksModel->save([
            'title' =>  $this->request->getVar('title'),
            'slug' =>  $slug,
            'writer' =>  $this->request->getVar('writer'),
            'publiser' =>  $this->request->getVar('publiser'),
            'cover' =>  $coverName,
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
            ],
            'cover' =>  [
                //'rules' =>  'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover, image/jpg,image/jpeg,image/png]',
                'rules' =>  'max_size[cover,1024]|is_image[cover]|mime_in[cover, image/jpg,image/jpeg,image/png]',
                'errors'    =>  [
                    //'uploaded'  =>  'Choose image first.',
                    'max_size'  =>  'Your image is too big.',
                    'is_image'  =>  'Your file is not image.',
                    'mime_in'   =>  'Your file is not image.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            //return redirect()->to('/books/edit/' . $books['slug'])->withInput()->with('validation', $validation);
            return redirect()->to('/books/edit/' . $books['slug'])->withInput();
        }

        //get cover
        $coverFile = $this->request->getFile('cover');
        if ($coverFile->getError() == 4) {
            $coverName = $this->request->getVar('oldCover');
        } else {
            //get cover file name (randomname)
            $coverName = $coverFile->getRandomName();

            //move cover to image folder
            $coverFile->move('image', $coverName);
            if ($coverName != 'default.jpg') {
                unlink('image/' . $this->request->getVar('oldCover'));
            }
        }

        $new_slug = url_title($title, '-', true);
        $id_books = $this->request->getVar('id_books');
        $book_data = [
            'title' =>  $title,
            'slug' =>  $new_slug,
            'writer' =>  $this->request->getVar('writer'),
            'publiser' =>  $this->request->getVar('publiser'),
            'cover' =>  $coverName,
        ];

        $this->booksModel->update($id_books, $book_data);

        session()->setFlashdata('message', 'Update Data Success!');

        return redirect()->to('/books');
    }

    public function delete($id_books)
    {
        //get cover by id
        $book = $this->booksModel->find($id_books);

        if ($book['cover'] != 'default.jpg') {
            // delete cover
            unlink('image/' . $book['cover']);
        }

        $this->booksModel->delete($id_books);

        session()->setFlashdata('message', 'Delete Data Success!');

        return redirect()->to('/books');
    }
}
