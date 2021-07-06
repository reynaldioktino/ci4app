<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <h1>Daftar Buku</h1>
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
                    <?php foreach ($books as $value) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><img src="/image/<?= $value['cover']; ?>" alt="" class="sampul"></td>
                            <td><?= $value['title']; ?></td>
                            <td><a href="/books/<?= $value['slug']; ?>" class="btn btn-primary">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>