<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
                            <select class="js-example-basic-single form-control" name="desa">
                            </select>
                            <?= form_error('desa', '<p class="text-danger">', '</p>') ?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                ajax: {
                    url: "<?= base_url('select/getDataAjaxRemote') ?>",
                    dataType: 'json',
                    type: 'post',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page
                        }
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.items,
                            pagination: {
                                more: data.total_count
                            }
                        };
                    },
                    cache: true,
                },
                placeholder: 'Ketik nama desa atau kecamatan',
                minimumInputLength: 3,
                templateResult: format,
                templateSelection: formatSelection
            });

            function format(daerah) {
                if (daerah.loading) {
                    return daerah.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(daerah.text);

                return $container;
            }

            function formatSelection(daerah) {
                return daerah.text;
            }

        });
    </script>
</body>

</html>