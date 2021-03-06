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
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="<?= base_url('select/add') ?>" class="btn btn-primary mb-2">Tambah Data</a>
                        <a href="<?= base_url('select/autocomplete') ?>" class="btn btn-primary mb-2">Tambah Data - AutoComplete</a>
                        <a href="<?= base_url('select/ajaxremote') ?>" class="btn btn-primary mb-2">Tambah Data - Select2 AJAX Remote</a>
                        <a href="<?= base_url('select/multiple') ?>" class="btn btn-primary mb-2">Multiple Select</a>
                        <?= $this->session->flashdata('status'); ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat Lengkap</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($customers as $customer) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $customer['customer'] ?></td>
                                        <td><?= $customer['alamat'] . ", Desa " . $customer['desa'] . ", Kecamatan " . $customer['kecamatan'] . ", Kabupaten " . $customer['kabupaten'] . ", Provinsi " . $customer['provinsi'] ?></td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('select/getById/' . $customer['id'] . '/edit') ?>" class="btn btn-warning btn-sm">edit</a>
                                            <a href="<?= base_url('select/getById/' . $customer['id'] . '/delete') ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Anda yakin akan dihapus?')">delete</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>