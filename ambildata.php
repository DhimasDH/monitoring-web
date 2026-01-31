<?php
include './assets/func.php';
$pendaki=new kelas_pendaki;
$koneksi=$pendaki->koneksi();
$qm=mysqli_query($koneksi, "SELECT latitude, longitude, id_pendaki FROM log_pendaki ORDER BY waktu DESC LIMIT 1");
                                    while($dm=mysqli_fetch_assoc($qm)) {
                                        $latit=$dm['latitude'];
                                        $longi=$dm['longitude'];
                                        $idp=$dm['id_pendaki'];
                                    echo "$latit" . "|" . "$longi" . "|" . "$idp";}?>
<script>
    setTimeout(function(){
        location.reload();
    }, 3000); // 10000 ms = 10 detik
</script>