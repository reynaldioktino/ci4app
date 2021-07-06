<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Hello, World!</h1>
            <?php
            foreach ($tes as $value) {
                echo $value . '<br>';
            }
            ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>