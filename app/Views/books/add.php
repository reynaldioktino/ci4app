<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="my-3">Form Add Books</h1>
            <form action="/books/insert" method="POST">
                <?php csrf_field(); ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Writer</label>
                    <input type="text" class="form-control" name="writer">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Publisher</label>
                    <input type="text" class="form-control" name="publiser">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Cover</label>
                    <input type="text" class="form-control" name="cover">
                </div>
                <button type="submit" class="btn btn-primary">+ Add Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>