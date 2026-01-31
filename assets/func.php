<?php
class kelas_pendaki {
    function koneksi() {
        $koneksi = mysqli_connect("localhost", "user_pendaki", "kelompok4", "smart_gps_tracker");
        return $koneksi;
    }
}
?>