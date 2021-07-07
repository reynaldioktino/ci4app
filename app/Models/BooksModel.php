<?php

namespace App\Models;

use CodeIgniter\Model;

class BooksModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id_books';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'slug', 'writer', 'publiser', 'cover'];

    public function getBooks($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
