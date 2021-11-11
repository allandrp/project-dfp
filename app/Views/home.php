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

    #lblCartCount {
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
                        <a class="nav-link" href="<?= base_url('/PembelianController/index') ?>">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/LoginController/logout') ?>">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('CartController/index') ?>">
                            <i class="fa mt-2" style="font-size:24px">&#xf07a;</i>
                            <span class='badge badge-warning' id='lblCartCount'> <?php
                                                                                    if ($jumlah_barang != null) {
                                                                                        echo $jumlah_barang;
                                                                                    } else {
                                                                                        echo 0;
                                                                                    }

                                                                                    ?> </span>
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

    <!-- Crousel Promo -->
    <div class="container p-0" style="margin-top: 100px;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="border-radius: 30px; width: 100%;">
                <div class="carousel-item active">
                    <img src="/image/Tokopedia1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/image/Tokopedia2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/image/Tokopedia3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Batas Carousel -->

    <!-- Kategori -->
    <div class="container px-0 pt-0 border-bottom">
        <div class="container px-3 pt-4 pb-5" style="margin-top: 20px; border-radius: 30px;">
            <h2 style="text-align: center;">Kategori</h2>
            <div class="row my-3 justify-content-center">
                <div class="col-3 d-flex justify-content-center py-3" style="width: fit-content;">
                    <a href="<?= base_url('KategoriController/index?kategori=mainan') ?>" style="text-decoration: none;" class="text-muted">
                        <div class=" card pt-4 px-4 pb-2" style="width: 100%;">
                            <img src="/image/Mainan.png" class="card-img-top mt-2" alt="..." width="100px" height="100px" style="object-fit: contain;">
                            <div class="card-body" style="text-align: center;">
                                <h5>Mainan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3 d-flex justify-content-center py-3" style="width: fit-content;">
                    <a href="<?= base_url('KategoriController/index?kategori=perabotan') ?>" style="text-decoration: none;" class="text-muted">
                        <div class="card pt-4 px-4 pb-2" style="width: 100%;">
                            <img src="/image/Lemari.png" class="card-img-top mt-2" alt="..." width="100px" height="100px" style="object-fit: contain;">
                            <div class="card-body" style="text-align: center;">
                                <h5>Perabotan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3 d-flex justify-content-center py-3" style="width: fit-content;">
                    <a href="<?= base_url('KategoriController/index?kategori=buku') ?>" style="text-decoration: none;" class="text-muted">
                        <div class="card pt-4 px-4 pb-2" style="width: 100%;">
                            <img src="/image/Buku2.png" class="card-img-top mt-2" alt="..." width="100px" height="100px" style="object-fit: contain;">
                            <div class="card-body" style="text-align: center;">
                                <h5>Buku</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-3 d-flex justify-content-center py-3" style="width: fit-content;">
                    <a href="<?= base_url('KategoriController/index?kategori=pakaian') ?>" style="text-decoration: none;" class="text-muted">
                        <div class="card pt-4 px-4 pb-2" style="width: 100%;">
                            <img src="/image/Pakaian.png" class="card-img-top mt-2" alt="..." width="100px" height="100px" style="object-fit: contain;">
                            <div class="card-body" style="text-align: center;">
                                <h5>Pakaian</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Batas Kategori -->

    <!-- List Barang -->
    <div class="container mt-4">
        <div class="row">
            <?php

            use App\Controllers\HomeController;

            foreach ($barang as $barang) { ?>
                <div class="col-2 mt-4 d-flex">
                    <div class="card flex-fill" style="width: 100%">
                        <img src="<?= base_url('image/' . $barang['foto']) ?>" class="card-img-top" height="150px" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: 600; overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2;
   -webkit-box-orient: vertical;"><?= $barang['nama_barang'] ?></h5>
                            <p class="card-text" style="font-weight: bold; color:var(--Y500,#FA591D); margin-top: 0px;">Rp. <?= number_format($barang['harga']) ?></p>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $barang['lokasi'] ?></h6>
                            <input type="hidden" value="<?= $barang['id_barang'] ?>">
                            <button type="button" class="mt-2 btn btn-outline-success" id="tambah<?= $barang['id_barang'] ?>">add to chart</button>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#tambah<?= $barang['id_barang'] ?>").click(function() {
                            $.post(" <?= base_url('HomeController/ajaxtambahcart') ?>", {
                                id_barang: <?= $barang['id_barang'] ?>
                            }, function(data, status) {
                                alert("barang ditambahkan ke cart");
                                document.getElementById("lblCartCount").innerHTML = data;
                            });
                        });
                    });
                </script>
            <?php } ?>
        </div>
    </div>
    <!-- Batas List Barang -->

    <!-- Footer -->
    <div class="border-top mt-5">
        <div class="container p-5">
            <h5>@Copyright</h5>
        </div>
    </div>
    <!-- Footer -->

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