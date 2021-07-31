<div class="container">
    <div class="row">
        <div class="col-6">
            <h3>Daftar Mahaiswa</h3>
                <ul class="list-group">
                    <?php foreach ( $data['mhs'] as $mhs) : ?>
                        <li class="list-group-item">
                            <?= $mhs['nama']; ?>
                            <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= $mhs['id']; ?>/" class="badge badge-primary d-flex justify-content-end">Detail</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
        </div>
    </div>
</div>