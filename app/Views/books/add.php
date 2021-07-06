<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="my-3">Form Add Books</h3>
            <form action="/books/insert" method="POST">
                <?php csrf_field(); ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Title</label>
                    <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" autofocus value="<?= old('title'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('title'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Writer</label>
                    <input type="text" class="form-control" name="writer" value="<?= old('writer'); ?>">
                </div>
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Publisher</label>
                    <input type="text" class="form-control" name="publiser" value="<?= old('publiser'); ?>">
                </div>
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Cover</label>
                    <input type="text" class="form-control" name="cover" value="<?= old('cover'); ?>">
                </div>
                <button type=" submit" class="btn btn-primary">+ Add Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>