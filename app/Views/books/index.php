<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <h1>Daftar Buku</h1><br>
            <a href="/books/add" class="btn btn-success">+ Add Books</a><br><br>
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($books as $value) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><img src="/image/<?= $value['cover']; ?>" alt="" class="sampul"></td>
                            <td><?= $value['title']; ?></td>
                            <td><a href="/book/<?= $value['slug']; ?>" class="btn btn-primary">Details</a></td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>