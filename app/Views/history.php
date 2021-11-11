<?php
// Set your Merchant Server Key

use App\Models\DetailPembelianModel;

\Midtrans\Config::$serverKey = 'SB-Mid-server-TrtH9rgau3tx06BkSe5WGNf1';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = false;
?>
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
    <script src="<?= base_url('js/number.js') ?>"></script>
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

    .judulkonten {
        background-color: #90d26d;
        background-image: url("<?= base_url('judul.jpg') ?>");
        padding: 40px 0px;
        opacity: 0.5;
        background-position: 0px -70.3185px;
    }

    .judulkonten h1 {
        text-transform: uppercase;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15) !important;
        font-family: Arial, Helvetica, sans-serif;
        color: #fff;
        font-size: 40px;
        font-weight: 600;
        letter-spacing: 2px;
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
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Home</a>
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
                                                                                    if ($jumlah_barang_cart['jumlah_barang'] != null) {
                                                                                        echo $jumlah_barang_cart['jumlah_barang'];
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

    <!-- judul -->
    <div class="container-fluid judulkonten" style="margin-top: 70px;">
        <div class="container-xl">
            <h1>History</h1>
        </div>
    </div>
    <!-- batas judul -->

    <!-- List Barang -->
    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">TANGGAL</th>
                    <th scope="col" class="text-center">JUMLAH</th>
                    <th scope="col" class="text-center">STATUS</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pembelian as $pembelian) {
                ?>
                    <tr>
                        <?php
                        $transaksi = new Midtrans\Transaction;
                        $status = $transaksi::status($pembelian['id_pembelian']);
                        ?>
                        <th class="align-middle text-center"><?= $status->order_id ?></th>
                        <td class="align-middle text-center"><?= $status->transaction_time ?></td>
                        <td class="align-middle text-center"><?= $pembelian['jumlah_barang'] ?></td>
                        <td class="align-middle text-center">
                            <div class="badge bg-<?php if ($status->transaction_status == "pending") {
                                                        echo "secondary ";
                                                    } else if ($status->transaction_status == "settlement") {
                                                        echo "success ";
                                                    } else {
                                                        echo "danger ";
                                                    } ?>text-wrap" style="width: 6rem;">
                                <?= $status->transaction_status ?>
                            </div>
                        </td>
                        <td class="align-middle text-center"><button type="button" class="badge bg-primary text-wrap" id="tombol<?= $status->order_id ?>" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $status->order_id ?>">DETAIL</button></td>
                    </tr>

                    <?php
                    $ModelDetail = new DetailPembelianModel();
                    $detail = $ModelDetail->where('id_pembelian', $status->order_id)->findAll();
                    ?>

                    <!-- modal detail berita -->
                    <div class="modal fade" id="exampleModal<?= $status->order_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Pembelian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $total_harga = 0;
                                    foreach ($detail as $d) { ?>
                                        <div class="row text-muted pb-3">
                                            <div class="col-6" id="namabarang"><?php echo $d['nama_barang'] . " " . $d['jumlah_barang'] . "x" ?> </div>
                                            <div class="col-6 text-end" id="totalhargasemua">Rp. <?= number_format($d['harga'] * $d['jumlah_barang']) ?></div>
                                        </div>
                                    <?php
                                        $total_harga = $total_harga + $d['harga'] * $d['jumlah_barang'];
                                    }
                                    ?>
                                    <div class="row pt-3 border-top">
                                        <div class="col-6">Total Harga </div>
                                        <div class="col-6 text-end" id="totalhargasemua2">Rp. <?= number_format($total_harga) ?></div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-6">Status</div>
                                        <div class="col-6 text-end" id="totalhargasemua2"><?= $status->transaction_status ?></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal detail berita -->

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Batas List Barang -->


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