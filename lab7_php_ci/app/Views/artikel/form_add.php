<?= $this->include('template/admin_header') ?>

<h2><?= $title ?></h2>

<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label>Judul</label><br>
        <input type="text" name="judul" class="form-control" required>
    </p>
    <p>
        <label>Kategori</label><br>
        <select name="id_kategori" class="form-control" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>Isi Artikel</label><br>
        <textarea name="isi" rows="10" class="form-control" required></textarea>
    </p>
    <p>
        <label>Gambar</label><br>
        <input type="file" name="gambar" accept="image/*">
    </p>
    <button type="submit" class="btn btn-primary">Simpan Artikel</button>
</form>

<?= $this->include('template/admin_footer') ?>