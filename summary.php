<?php
include './assets/func.php';
$pendaki=new kelas_pendaki;
$koneksi=$pendaki->koneksi();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Summary Data</title>
    
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <meta http-equiv="refresh" content="3">

    <style>
        /* Agar background transparan mengikuti parent */
        html, body {
            background: transparent !important; 
        }
        /* Perbaikan padding agar tidak mepet iframe */
        .container-fluid {
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row" id="summary">
        <?php
        $qw=mysqli_query($koneksi, "SELECT latitude, longitude, heart_rate, spo2 FROM log_pendaki ORDER BY waktu DESC LIMIT 1");
        
        // Cek jika data ada
        if(mysqli_num_rows($qw) > 0) {
            while($dw=mysqli_fetch_assoc($qw)) {
                $lat=$dw['latitude'];
                $long=$dw['longitude'];
                $hr=$dw['heart_rate'];
                $sp02=$dw['spo2'];
                
                echo "
                <div class='col-xl-3 col-md-6'>
                    <div class='mb-3'>
                        <div class='card text-black' style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                            <div class='card-body'><b>LATITUDE</b></div>
                            <div class='card-footer d-flex align-items-center justify-content-between'>
                                <div class='ms-10'>ID 1: <b>$lat</b></div>
                            </div> 
                        </div>
                    </div>
                    <div class='mb-3'>
                        <div class='card text-black' style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                            <div class='card-body'><b>HEART RATE</b></div>
                            <div class='card-footer d-flex align-items-center justify-content-between'>
                                <div class='ms-10'>ID 1: <b>$hr bpm</b></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-xl-3 col-md-6'>
                    <div class='mb-3'>
                        <div class='card text-black' style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                            <div class='card-body'><b>LONGITUDE</b></div>
                            <div class='card-footer d-flex align-items-center justify-content-between'>
                                <div class='ms-10'>ID 1: <b>$long</b></div>
                            </div>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <div class='card text-black' style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                            <div class='card-body'><b>OKSIMETER</b></div>
                            <div class='card-footer d-flex align-items-center justify-content-between'>
                                <div class='ms-10'>ID 1: <b>$sp02 %</b></div>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            // Tampilkan placeholder jika data kosong agar layout tidak hancur
            echo "<div class='col-12'><p class='text-center text-white'>Menunggu Data...</p></div>";
        }
        ?>
            
            <div class='col-xl-6 col-md-12'>
                <div class='card mb-4' style='background-color: rgba(255,255,255,0.5); backdrop-filter: blur(5px);'>
                    <div class='card-header'>
                        <i class='fas fa-table me-1'></i>
                        Pendaki
                    </div>
                    <div class='card-body'>
                        <table id='datatablesSimple' class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID Pendaki</th>
                                    <th>SOS</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qt=mysqli_query($koneksi,"SELECT id_pendaki, is_sos, waktu as waktu_terbaru FROM log_pendaki ORDER BY waktu DESC LIMIT 1");
                                while($dt=mysqli_fetch_row($qt)){
                                        $id=$dt[0];
                                        $sos=$dt[1];
                                        $waktu=$dt[2];
                                        echo "<tr>
                                                <td>$id</td>";
                                                if($sos=="0") {
                                                    echo "<td><b>AMAN</b></td>";
                                                } else {
                                                    echo "<td><span class='badge bg-danger'>BUTUH BANTUAN</span></td>";
                                                }
                                        echo "<td>$waktu</td>
                                            </tr>";
                                        
                                        // Alert ditaruh di luar TR agar valid HTML
                                        if($sos!="0") {
                                            echo "<tr><td colspan='3'>
                                                <div class='alert alert-danger alert-dismissible fa-beat mb-0'>
                                                    <strong>ID $id BUTUH BANTUAN</strong>.
                                                </div>
                                            </td></tr>";
                                        }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>