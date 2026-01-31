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
        <meta http-equiv="refresh" content="3">
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
                            <a class="nav-link collapsed" href="#">
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
                        <h1 class="mt-4">Pendaki</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Informasi Kesehatan Pendaki</li>
                        </ol>
                        <div class="card mb-4" style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Kesehatan Pendaki
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Pendaki</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Heart Rate</th>
                                            <th>Oxymeter</th>
                                            <th>Status</th>
                                            <th>SOS</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $qt=mysqli_query($koneksi,"SELECT id_pendaki, latitude, longitude, heart_rate, spo2, status_alat, is_sos, waktu FROM log_pendaki ORDER BY waktu DESC LIMIT 1");
                                            while($dt=mysqli_fetch_row($qt)){
                                                $id=$dt[0];
                                                $lat=$dt[1];
                                                $long=$dt[2];
                                                $hr=$dt[3];
                                                $spo2=$dt[4];
                                                $status=$dt[5];
                                                $sos=$dt[6];
                                                $waktu=$dt[7];
                                                echo" <tr>
                                                        <td>$id</td>
                                                        <td>$lat</td>
                                                        <td>$long</td>
                                                        <td>$hr</td>
                                                        <td>$spo2</td>
                                                        <td>$status</td>";
                                                        if($sos=="0") {
                                                        echo "<td><b>AMAN</b></td>";
                                                        }
                                                        else {
                                                            echo"<td><span class='badge bg-danger'>BUTUH BANTUAN</span></td>
                                                                <div class='alert alert-danger alert-dismissible fa-fade'>
                                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                                <strong>ID $id BUTUH BANTUAN</strong>.
                                                                </div>";
                                                        }
                                                    echo"<td>$waktu</td>
                                                    </tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
            background-repeat: no-repeat !important;
        }
        </style>
    </body>
</html>
