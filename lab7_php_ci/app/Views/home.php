<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
    <h1><?= $title ?? 'Selamat Datang' ?></h1>
    <hr>
    <p>Ini halaman Home menggunakan View Layout baru</p>
<?= $this->endSection() ?>