<?php
//menyertakan file dari database dan kripto untuk bisa dipanggil pada file ini
include 'database.php';
$db = new database();

include 'kripto.php';
$kript = new Kriptografi();

$jn = 'index.php';
//variabel untuk menentukan aksi
$act = $_GET['act'];

if ($act == "tambah") {         //menambahkan data kedalam database
    $date = date("Y-m-d");
    //melakukan enkripsi terhadap value
    foreach ($_POST as $key => $value) {
        if ($key == 'jlhbarang') { continue; }
        else {
            $kript->setWord($value, 'enkripsi');
            $_POST[$key] = $kript->getCipher();
        }
    }
    $kript->setWord($date, 'enkripsi');
    $tgltitip = $kript->getCipher();
    $kript->setWord('0000-00-00', 'enkripsi');
    $tglambil = $kript->getCipher();
    //mengirimkan setiap value untuk dimasukkan ke dalam database
    $db->inputtitip($_POST['noktp'],$_POST['namapenitip'],$_POST['notelp'],$_POST['jenisbarang'],$_POST['jlhbarang'],$tgltitip, $tglambil);
}

elseif ($act == "ambil") {      // menambahkan data waktu pengambilan barang kedalam database
    $date=date("Y-m-d");
    $kript->setWord($date, 'enkripsi');
    $date = $kript->getCipher();
    $db->inputambil($_GET['kode'],$date);
}

elseif ($act == "loginadm") {   //melmeriksa login admin, jika password atau kode salah maka tidak dapat login
    if ($db->cekpassadm($_POST['idadm'],$_POST['pass']) != 0) {
        session_start();
        $_SESSION['login']= $_POST['idadm'];
    } else {
        $jn= "index.php?msg=1";
    }   
}

elseif ($act == "logout") {     //menghancurkan session untuk logout
	session_start();
	session_destroy();
}

header("location: $jn ");