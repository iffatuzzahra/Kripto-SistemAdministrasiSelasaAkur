<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="../RPL-Web-Library_Information_System/admin-mode/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php  
session_start();

include 'database.php';
$db = new Database();
?>
<header>
    <h2 class="p-3">
        <?php
        if (!empty($_SESSION['login'])) { ?>
            <div>
                <!--Button untuk logout-->
                <a href="proses.php?act=logout" style="float: right; ">
                <button type="submit" class="btn btn-danger ">Keluar</button></a>
            </div>
        <?php }
        ?>
        <center>Sistem Administrasi Penitipan Barang Selasa Akur</center>
    </h2>
</header>
<main > 
<div class="container">
    <?php //Login Petugas
    if (empty($_SESSION['login'])) {
        if (!empty($_GET['msg'])) {
            echo "<script>alert('Login gagal')</script>";
        }
        ?>
        <div class="card p-4 bg-light" style="margin-left:20rem; width: 28rem">
        <form action="proses.php?act=loginadm" method="post">
            <div class="container" >
            <div class="form-group p-3 row">
                <label >Masukkan Kode Admin</label>
                <input type="text" class="form-control" name="idadm">
                <label >Masukkan PIN / Password </label>
                <input type="password" class="form-control" name="pass">
            </div>
            <h6 style="color:red;"><i>Hanya Admin yang Diizinkan Masuk</i></h6>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div> 
        </form></div>

    <?php
    } else {
    ?>
    <table class="table">
        <thead>
            <th><center>Tabel Penitipan Barang</center></th>
            <th ><center>Form Input Penitipan</center></th>
        </thead>
        <tr>
            <td> 
            <!--Filter view data-->
            <div style="padding-bottom:10px">
                <a href="index.php?view=semua">Semua</a> | 
                <a href="index.php?view=belumdiambil">BelumDiambil</a> |
                <a href="index.php?view=diambil">Diambil</a>
            </div>
            <!--Kolom tabel penitipan barang-->
            <table class="table">
                <thead>
                    <th>Kode Penitipan</th>
                    <th>Nama Penitip</th>
                    <th>Jenis Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal penitipan</th>
                    <th>Tanggal pengambilan</th>
                    <th>Detail</th>
                </thead>
                <?php
                    if (empty($_GET['view'])) { $_GET['view'] = 'semua'; } 
                    if(($db->countdata()) == 0 ) {
                        ?> <tr><td colspan=7>Tidak Ada Data, Silakan Input Melalui Form Untuk Menembahkan Data!</td></tr>
                        <?php
                    } else {
                    foreach (($db->tampildata($_GET['view'])) as $data) { ?>
                    <tr>
                        <td><?=$data['kodetitip']?></td>
                        <td><?=$data['namapenitip']?></td>
                        <td><?=$data['namabarang']?></td>
                        <td><?=$data['jlhbarang']?></td>
                        <td><?=$data['tgltitip']?></td>
                        <td><?php
                            //melakukan filter apabila tanggal ambil belum ada, maka ditampilkan button untuk melakukan pengambilan
                            if ($data['tglambil'] == '0000-00-00') { ?> 
                                <a href="proses.php?act=ambil&kode=<?=$data['kodetitip']?>">
                                <button class="btn btn-warning">BelumDiambil</button></a>
                                <?php
                            } else {
                                echo $data['tglambil'];
                            }
                        ?></td>
                        <td>
                            <a href="detailpage.php?kode=<?=$data['kodetitip']?>">
                            <button class="btn btn-warning">Detail</button></a>
                        </td>
                    </tr>     
                <?php } }
                ?>
            </table>
            </td>
            <td>
            <!--Kolom input penyerahan / penitipan barang-->
                <div class="form-group">
                <form action="proses.php?act=tambah" method="post">
                    <table>
                        <tr >
                            <td> No KTP </td>
                            <td> : </td>
                            <td> <input class="form-control" type="text" name="noktp" value=""> </td>
                        </tr>
                        <tr>
                            <td> Nama Penitip </td>
                            <td> : </td>
                            <td> <input class="form-control" type="text" name="namapenitip" value=""> </td>
                        </tr>
                        <tr>
                            <td> HP / No Telp </td>
                            <td> : </td>
                            <td> <input class="form-control" type="text" name="notelp" value=""> </td>
                        </tr>
                        <tr>
                            <td> Jenis Barang </td>
                            <td> : </td>
                            <td> <input class="form-control" type="text" name="jenisbarang" value=""> </td>
                        </tr>
                        <tr>
                            <td> Jumlah Barang </td>
                            <td> : </td>
                            <td> <input class="form-control" type="text" name="jlhbarang" value=""> </td>
                        </tr>
                        <tr>
                            <td rowspan="3"> 
                                <button class="btn btn-primary" type="submit">Submit
                                </button>
                                <!--<input class="btn btn-secondary" type="reset" value="Clear">
                                <button class="btn btn-secondary" type="reset">Clear
                                </button> -->
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
            </td>
        </tr>
    </table>
    <?php } ?>
</div>
</main>
</body>
</html>