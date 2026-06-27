<?= $this->include('template/admin_header') ?>

<h2><?= $title ?></h2>

<div class="row mb-3">
    <div class="col-md-8">
        <form id="search-form" class="form-inline">
            <input type="text" name="q" id="search-box" 
                   value="<?= $q ?>" 
                   placeholder="Cari judul artikel..." 
                   class="form-control mr-2" style="width:300px">

            <select name="kategori_id" id="category-filter" class="form-control mr-2">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>" 
                            <?= ($kategori_id == $k['id_kategori']) ? 'selected' : '' ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>
</div>

<!-- Container untuk data tabel dari AJAX -->
<div id="article-container"></div>

<!-- Container untuk pagination -->
<div id="pagination-container" class="mt-3"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const searchForm = $('#search-form');

    function fetchData(url) {
        articleContainer.html('<p class="text-center">Loading data...</p>');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(data) {
                renderArticles(data.artikel);
                renderPagination(data.pager, data.q, data.kategori_id);
            },
            error: function() {
                articleContainer.html('<p class="text-danger">Gagal memuat data.</p>');
            }
        });
    }

    function renderArticles(articles) {
        let html = `
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>`;

        if (articles.length > 0) {
            articles.forEach(article => {
                html += `
                    <tr>
                        <td>${article.id}</td>
                        <td><b>${article.judul}</b><br>
                            <small>${article.isi.substring(0, 80)}...</small>
                        </td>
                        <td>${article.nama_kategori || '-'}</td>
                        <td>${article.status}</td>
                        <td>
                            <a href="/admin/artikel/edit/${article.id}" class="btn btn-sm btn-info">Ubah</a>
                            <a href="/admin/artikel/delete/${article.id}" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>`;
            });
        } else {
            html += `<tr><td colspan="5" class="text-center">Tidak ada data.</td></tr>`;
        }

        html += `</tbody></table>`;
        articleContainer.html(html);
    }

    function renderPagination(pager, q, kategori_id) {
        let html = '<nav><ul class="pagination">';
        
        pager.links.forEach(link => {
            let url = link.url ? 
                `${link.url}&q=${encodeURIComponent(q)}&kategori_id=${kategori_id}` : '#';
            html += `
                <li class="page-item ${link.active ? 'active' : ''}">
                    <a class="page-link" href="${url}">${link.title}</a>
                </li>`;
        });

        html += '</ul></nav>';
        paginationContainer.html(html);
    }

    // Event Listeners
    searchForm.on('submit', function(e) {
        e.preventDefault();
        const q = $('#search-box').val();
        const kategori_id = $('#category-filter').val();
        fetchData(`/admin/artikel?q=${encodeURIComponent(q)}&kategori_id=${kategori_id}`);
    });

    $('#category-filter').on('change', function() {
        searchForm.trigger('submit');
    });

    // Load pertama
    fetchData('/admin/artikel');
});
</script>

<?= $this->include('template/admin_footer') ?>