<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $title; ?></h1><br>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/image/<?= $book['cover']; ?>" class="img-fluid rounded-start" alt="..." style="height: 220px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $book['title']; ?></h5>
                            <hr>
                            <p class="card-text"><b>Penulis : </b><?= $book['writer']; ?></p>
                            <p class="card-text"><b>Penerbit : </b><small class="text-muted"><?= $book['publiser']; ?></small></p>
                            <a href="/books/edit/<?= $book['slug']; ?>" class="btn btn-warning btn-sm">Update</a>
                            <form action="/book/<?= $book['id_books']; ?>" method="POST" class="d-inline">
                                <?php csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/books">Kembali ke daftar buku</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>