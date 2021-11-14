<?php
// Set your Merchant Server Key
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-X1vwHcptrPNqfmbA"></script>
    <script src="<?= base_url('js/number.js') ?>"></script>
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
                        <a class="nav-link" href="<?= base_url('/PembelianController/index') ?>">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/LoginController/logout') ?>">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="">
                            <i class="fa mt-2" style="font-size:24px">&#xf07a;</i>
                            <span class='badge badge-warning' id='labeltotalbarang1'>
                                <?php
                                if ($cart != null) {
                                    echo $jumlah_barang['jumlah_barang'];
                                } else {
                                    echo 0;
                                }

                                ?></span>
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
                <?php
                $cart2 = array();
                foreach ($cart as $c) {
                    $cart2[] = $c; ?>
                    <!-- card foto samping -->
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= base_url('image/' . $c['foto']) ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
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

                                        location.reload();

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

                                        location.reload();

                                    }
                                });
                            });
                        });
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
                                    <input type="hidden" value="<?= $total_harga['total_harga'] ?>">
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-success mt-5" id="tombolbeli" style="font-weight: bold;">Beli (<?= $jumlah_barang['jumlah_barang'] ?>)</button>

                                    <!-- midtrans -->
                                    <?php
                                    $session = session();
                                    $time = time();

                                    if ($cart != null) {

                                        // set batas kadaluarsa transaksi
                                        $custom_expiry = array(
                                            'start_time' => date("Y-m-d H:i:s O", $time),
                                            'unit' => 'day',
                                            'duration' => '1'
                                        );

                                        $transaction_details = array(
                                            'order_id' => rand(),
                                            'gross_amount' => $total_harga,
                                        );

                                        $customer_details = array(
                                            'first_name'       => $session->get('nama'),
                                            'last_name'        => "",
                                            'email'            => $session->get('email'),
                                            'phone'            => "",
                                            'billing_address'  => $session->get('alamat'),
                                            'shipping_address' => $session->get('alamat')
                                        );
                                        $count = 0;
                                        $items = array();
                                        foreach ($cart2 as $c) {
                                            $itemtemp =  array(
                                                'id'       => $c['id_barang'],
                                                'price'    => $c['harga'],
                                                'quantity' => $c['jumlah_barang'],
                                                'name'     => $c['nama_barang']
                                            );

                                            $items[$count] = $itemtemp;
                                            $count = $count + 1;
                                        }
                                        $transaction_data = array(
                                            'transaction_details' => $transaction_details,
                                            'item_details'        => $items,
                                            'customer_details'    => $customer_details,
                                            'expiry' => $custom_expiry

                                        );
                                        $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
                                    ?>
                                        <script>
                                            document.getElementById('tombolbeli').onclick = function() {
                                                // SnapToken acquired from previous step
                                                snap.pay('<?= $snapToken ?>', {
                                                    // Optional
                                                    onSuccess: function(result) {
                                                        /* You may add your own js here, this is just example */
                                                        window.location = "http://localhost:8080/cartController/resetCart?order_id=" + result['order_id'];
                                                    },
                                                    // Optional
                                                    onPending: function(result) {
                                                        /* You may add your own js here, this is just example */
                                                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                                        window.location = "http://localhost:8080/cartController/resetCart?order_id=" + result['order_id'];
                                                    },
                                                    // Optional
                                                    onError: function(result) {
                                                        /* You may add your own js here, this is just example */
                                                    }
                                                });
                                            };
                                        </script>
                                    <?php } ?>
                                    <!-- batas akhir midtrans -->

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