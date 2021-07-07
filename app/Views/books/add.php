<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="my-3">Form Add Books</h3>
            <form action="/books/insert" method="POST" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Book Title</label>
                    <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" autofocus value="<?= old('title'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('title'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Book Writer</label>
                    <input type="text" class="form-control" name="writer" value="<?= old('writer'); ?>">
                </div>
                <div class=" mb-3">
                    <label class="form-label">Book Publisher</label>
                    <input type="text" class="form-control" name="publiser" value="<?= old('publiser'); ?>">
                </div>
                <div class=" mb-3">
                    <label class="form-label">Book Cover</label>
                    <div class="col-sm-2">
                        <img src="/image/default.jpg" alt="" width="220px" class="img-preview">
                    </div>
                    <input type="file" id="cover" name="cover" class="form-control <?= ($validation->hasError('cover')) ? 'is-invalid' : ''; ?>" onchange="previewImg()">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('cover'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">+ Add Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>