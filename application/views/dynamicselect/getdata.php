<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title><?= $title ?></title>
</head>

<body>
    <div class="container">
        <div class="row mt-3 justify-content-md-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <?= form_open() ?>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Isikan nama lengkap">
                            <?= form_error('nama', '<p class="text-danger">', '</p>') ?>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                            <?= form_error('alamat', '<p class="text-danger">', '</p>') ?>

                        </div>

                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option value="">-- Pilih Provinsi --</option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id'] ?>"><?= $prov['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <select class="form-control" id="kabupaten" name="kabupaten" required>
                                <option value="">-- Pilih Kabupaten --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <select class="form-control" id="desa" name="desa" required>
                                <option value="">-- Pilih Desa --</option>
                            </select>
                        </div>
                        <a href="<?= base_url('select') ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Select Provinsi -> get Kabupaten
            $('#provinsi').change(function() {
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Select/getKabupaten') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#kabupaten').html(response);
                    }
                });
            })

            // Select Kabupaten -> Get Kecamatan
            $('#kabupaten').change(function() {
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Select/getKecamatan') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#kecamatan').html(response);
                    }
                });
            })

            // Select Kecamatan -> Get Desa
            $('#kecamatan').change(function() {
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Select/getDesa') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#desa').html(response);
                    }
                });
            })
        })
    </script>
</body>

</html>