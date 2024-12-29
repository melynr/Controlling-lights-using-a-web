<?php
//jika yang dipost adalah token, maka jalankan blok code if berikut ini
if (isset($_POST['token'])) {
    include 'config.php';
    //buat variabel $key untuk menampung token
    $key = $_POST['token'];

    //koneksi ke db dan mecocokkan token dengan tb_kontrol
    $sql = mysqli_query($dbcon, "SELECT * FROM tb_control WHERE token = '$key'");
    //hitung berapa data yang ada tokennya sama dengan $key
    $cekdata = mysqli_num_rows($sql);

    //jika ditemukan row dimana tokennya = $key
    if($cekdata > 0){
        //buat variabel untuk mengambil array di tb_kontrol
        $data = mysqli_fetch_assoc($sql);
    }else{
        //untuk merespon, $data beri keterangan "token tidak valid"
        $data = [
            "token"=>"Tidak Valid"
        ];
    }
    $respon = json_encode($data);
    echo $respon;

}
?>