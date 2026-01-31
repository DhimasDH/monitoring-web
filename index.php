<?php 
//koneksi ke database
include './assets/func.php';
$pendaki=new kelas_pendaki;
$koneksi=$pendaki->koneksi();
//masuk database
// $pass=password_hash("warga7", PASSWORD_DEFAULT);
// mysqli_query($koneksi, "INSERT INTO user(username,password,nama,alamat,kota,telepon,level,tipe,status) VALUES ('warga7','$pass','warga7','Tembalang','Semarang','024123','warga','Kos','AKTIF')");
// if(mysqli_affected_rows($koneksi) > 0) echo "data berhasil masuk";
// else echo "data gagal";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">SMART TRACKER GPS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <!-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul> -->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-primary"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="tabel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-person-hiking text-primary"></i></div>
                                Pendaki
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: kelompok 4</div>
                        Smart Tracker GPS
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <iframe id="summaryFrame" src="summary.php"
                        style="width:100%;border:none;height:275px;background: transparent;" 
                        allowtransparency="true"
                        frameborder="0"
                        scrolling="no"></iframe>
                        <!-- <script>
                        setInterval(() => {
                        const frame = document.getElementById("summaryFrame");
                        frame.src = "summary.php?" + Date.now();
                        }, 3000);
                        </script> -->
                        <div class="row" id="map">
                            <div class="col-xl-12">
                            <div class="card mb-4">
                            <div id="map" style="height: 500px; width: 100%;"></div>
                                <iframe id="statusFrame" src="ambildata.php" style="display:none;"></iframe>
                                <script>
                                    // Inisialisasi peta
                                    var map = L.map('map', {
                                        center: [-7.18, 110.33],
                                        zoom: 13,

                                        // Matikan semua zoom interaksi
                                        scrollWheelZoom: false,   // zoom pakai scroll = off
                                        doubleClickZoom: false,   // zoom double click = off
                                        touchZoom: false,         // zoom pinch HP = off
                                        boxZoom: false,           // zoom drag kotak = off
                                        keyboard: false           // zoom keyboard = off
                                    });
                                    var hikerIcon = L.divIcon({
                                        html: '<i class="fa-solid fa-person-hiking fa-2x" style="color: black;"></i>',
                                        className: 'myDivIcon',
                                        iconSize: [30, 30],
                                        iconAnchor: [15, 30]
                                    });
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19
                                    }).addTo(map);
                                    window.lastMarker = null;
                                    // Fungsi update marker tiap 5 detik
                                    setInterval(function () {
                                        var isi = document.getElementById("statusFrame").contentDocument.body.innerText;
                                        if (!isi.includes("|")) return;
                                        var part = isi.split("|");
                                        var lat = parseFloat(part[0]);
                                        var long = parseFloat(part[1]);
                                        var idp = part[2];
                                        // Hapus marker lama
                                        if (window.lastMarker) {
                                            map.removeLayer(window.lastMarker);
                                        }
                                        // Tambahkan marker baru
                                        window.lastMarker = L.marker([lat, long], { icon: hikerIcon })
                                            .addTo(map)
                                            .bindPopup("<b>ID Pendaki: " + idp + "</b>");
                                    }, 3000);
                                </script>
                                <style>
                                    /* WAJIB: map harus punya height, kalau tidak peta tidak tampil */
                                    #map {
                                        height: 500px;
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }
                                </style>
                                </div> 
                            </div> 
                        </div>
                    </div>
                </main>
                <footer class="py-4 mt-auto" style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <style>
        body {
            background: url("assets/img/gunung.jpeg") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: repeat !important;
        }
        </style>
    </body>
</html>
