<?= $this->include('template/header') ?>

<h1>Data Artikel dengan AJAX</h1>

<table class="table" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- jQuery Lokal -->
<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script>
$(document).ready(function() {
    function loadData() {
        $.ajax({
            url: "<?= base_url('ajax/getData') ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {
                let html = '';
                data.forEach(function(row) {
                    html += `<tr>
                        <td>${row.id}</td>
                        <td>${row.judul}</td>
                        <td>
                            <button class="btn btn-danger btn-delete" data-id="${row.id}">Hapus</button>
                        </td>
                    </tr>`;
                });
                $('#artikelTable tbody').html(html);
            }
        });
    }

    loadData();

    // Hapus data
    $(document).on('click', '.btn-delete', function() {
        if (confirm('Yakin ingin menghapus?')) {
            let id = $(this).data('id');
            $.ajax({
                url: "<?= base_url('ajax/delete/') ?>" + id,
                method: "POST",
                success: function() {
                    loadData();
                }
            });
        }
    });
});
</script>

<?= $this->include('template/footer') ?>