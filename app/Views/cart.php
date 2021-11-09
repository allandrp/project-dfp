<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3b9659dcfe.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Hello, world!</title>
</head>
<style>
    .header {
        background: rgb(0, 178, 255);
        color: #fff;
    }

    #labeltotalbarang1 {
        font-size: 12px;
        background: #ff0000;
        color: #fff;
        padding: 0 5px;
        vertical-align: top;
        margin-left: -10px;
    }

    .badge {
        padding-left: 9px;
        padding-right: 9px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;
        border-radius: 9px;
    }

    .label-warning[href],
    .badge-warning[href] {
        background-color: #c67605;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/image/LogoBootstrap.png" alt="" width="60" height="48" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/HomeController') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/LoginController/logout') ?>">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="">
                            <i class="fa mt-2" style="font-size:24px">&#xf07a;</i>
                            <span class='badge badge-warning' id='labeltotalbarang1'><?= $jumlah_barang['jumlah_barang'] ?></span>
                        </a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Batas Navbar -->

    <div class="container border p-4" style="margin-top: 100px;">
        <div class="row">
            <div class="col-6">
                <?php foreach ($cart as $c) { ?>
                    <div class="card mt-3">
                        <img src="<?= base_url('image/' . $c['foto']) ?>" class="card-img-top" style="max-height: 200px; object-fit: contain;" alt="gambar produk">
                        <div class="card-body">
                            <h5><?= $c['nama_barang'] ?></h5>
                            <p class="card-text" style="font-weight: bold; color:var(--Y500,#FA591D); margin-top: 0px;" id="hargasatuan">Rp. <?= number_format($c['total_harga'] / $c['jumlah_barang']) ?></p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="mt-2 btn btn-outline-success" id="minus<?= $c['id_barang'] ?>"><i class="fas fa-minus"></i></button>
                                        </div>
                                        <div class="col-4 pt-3 ps-4">
                                            <h5 class="card-subtitle mb-2 text-muted" id="jumlahbarang<?= $c['id_barang'] ?>"><?= $c['jumlah_barang'] ?></h5>
                                        </div>
                                        <div class="col-4"><button type="button" class="mt-2 btn btn-outline-success" id="plus<?= $c['id_barang'] ?>"><i class="fas fa-plus"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {

                            // ajax untuk mengurangi barang
                            $("#minus<?= $c['id_barang'] ?>").click(function() {
                                $.ajax({
                                    type: "POST",
                                    url: " <?= base_url('CartController/ajaxminuscart') ?>",
                                    data: {
                                        id_barang: <?= $c['id_barang'] ?>
                                    },
                                    dataType: "json", // Set the data type so jQuery can parse it for you
                                    success: function(data) {
                                        document.getElementById("jumlahbarang<?= $c['id_barang'] ?>").innerHTML = data['jumlah_barang_satuan'];
                                        document.getElementById("labeltotalbarang1").innerHTML = data['jumlah_barang'];
                                        document.getElementById("tombolbeli").innerHTML = "Beli (" + data['jumlah_barang'] + ")";
                                        document.getElementById("jumlahbarangsemua").innerHTML = "Total Harga (" + data['jumlah_barang'] + " Barang)";
                                        document.getElementById("totalhargasemua").innerHTML = "Rp." + number_format(data['total_harga']);
                                        document.getElementById("totalhargasemua2").innerHTML = "Rp." + number_format(data['total_harga']);

                                        if (data['jumlah_barang_satuan'] == null) {
                                            location.reload();
                                        }

                                    }
                                });
                            });

                            // ajax untuk tambah barang
                            $("#plus<?= $c['id_barang'] ?>").click(function() {
                                $.ajax({
                                    type: "POST",
                                    url: " <?= base_url('CartController/ajaxpluscart') ?>",
                                    data: {
                                        id_barang: <?= $c['id_barang'] ?>
                                    },
                                    dataType: "json", // Set the data type so jQuery can parse it for you
                                    success: function(data) {
                                        document.getElementById("jumlahbarang<?= $c['id_barang'] ?>").innerHTML = data['jumlah_barang_satuan'];
                                        document.getElementById("labeltotalbarang1").innerHTML = data['jumlah_barang'];
                                        document.getElementById("tombolbeli").innerHTML = "Beli (" + data['jumlah_barang'] + ")";
                                        document.getElementById("jumlahbarangsemua").innerHTML = "Total Harga (" + data['jumlah_barang'] + " Barang)";
                                        document.getElementById("totalhargasemua").innerHTML = "Rp." + number_format(data['total_harga']);
                                        document.getElementById("totalhargasemua2").innerHTML = "Rp." + number_format(data['total_harga']);

                                        if (data['jumlah_barang_satuan'] == null) {
                                            location.reload();
                                        }

                                    }
                                });
                            });
                        });

                        function number_format(number, decimals, decPoint, thousandsSep) {
                            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
                            var n = !isFinite(+number) ? 0 : +number
                            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
                            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
                            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
                            var s = ''

                            var toFixedFix = function(n, prec) {
                                var k = Math.pow(10, prec)
                                return '' + (Math.round(n * k) / k)
                                    .toFixed(prec)
                            }

                            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
                            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
                            if (s[0].length > 3) {
                                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
                            }
                            if ((s[1] || '').length < prec) {
                                s[1] = s[1] || ''
                                s[1] += new Array(prec - s[1].length + 1).join('0')
                            }

                            return s.join(dec)
                        }
                    </script>
                <?php } ?>
            </div>
            <div class="col-6">
                <div class="card mt-3 ringkasan <?php
                                                if ($jumlah_barang['jumlah_barang'] == null) {
                                                    echo "visually-hidden";
                                                }
                                                ?>">
                    <h4 class="border-bottom mt-3 text-center pb-3">Ringkasan Belanja</h4>
                    <div class="container">
                        <div class="card-body">
                            <h5 class="card-text" style=" margin-top: 0px;">
                                <div class="row border-bottom text-muted pb-3">
                                    <div class="col-6" id="jumlahbarangsemua">Total Harga (<?= $jumlah_barang['jumlah_barang'] ?> Barang) </div>
                                    <div class="col-6 text-end" id="totalhargasemua">Rp. <?= number_format($total_harga['total_harga']) ?></div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-6">Total Harga </div>
                                    <div class="col-6 text-end" id="totalhargasemua2">Rp. <?= number_format($total_harga['total_harga']) ?></div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-success mt-5" id="tombolbeli" style="font-weight: bold;">Beli (<?= $jumlah_barang['jumlah_barang'] ?>)</button>
                                </div>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>