<?= $this->include('template/header') ?>
<h1><?= $title ?></h1>
<?php if ($artikel): ?>
    <?php foreach ($artikel as $row): ?>
        <article class="entry">
            <h2><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></h2>
            <p><?= substr($row['isi'], 0, 200) ?>...</p>
        </article>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>Belum ada artikel.</p>
<?php endif; ?>
<?= $this->include('template/footer') ?>