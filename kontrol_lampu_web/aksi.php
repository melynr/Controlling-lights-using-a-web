<?php 
if(isset($_GET['channel'])&&isset($_GET['state'])){
    // panggil config.php untuk koneksi ke db
    include'config.php';
    //buat variabel $channel dan $state untuk menampubg request get
    $channel = $_GET['channel'];
    $state = $_GET['state'];

    if($channel=='1'){
        //jika channelnya 1 maka blok ini dijalankan
        //koneksi ke tb_kontrol, ke field led1
        mysqli_query($dbcon, "UPDATE tb_control SET lampu ='$state'");
        }
    header('location:index.php');
    exit;

   
}


?>