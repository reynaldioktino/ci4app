<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="my-3">Form Update Books</h3>
            <form action="/books/update" method="POST">
                <input type="hidden" name="slug" value="<?= $book['slug']; ?>">
                <input type="hidden" name="id_books" value="<?= $book['id_books']; ?>">
                <?php csrf_field(); ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Title</label>
                    <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" autofocus value="<?= (old('title')) ? old('title') : $book['title']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('title'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Writer</label>
                    <input type="text" class="form-control" name="writer" value="<?= (old('writer')) ? old('writer') : $book['writer']; ?>">
                </div>
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Publisher</label>
                    <input type="text" class="form-control" name="publiser" value="<?= (old('publiser')) ? old('publiser') : $book['publiser']; ?>">
                </div>
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Cover</label><br>
                    <img src="/image/<?= $book['cover']; ?>" alt="" class="sampul">
                    <input type="text" class="form-control" name="cover" value="<?= (old('cover')) ? old('cover') : $book['cover']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>