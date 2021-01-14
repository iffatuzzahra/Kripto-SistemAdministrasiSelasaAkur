<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" type="text/css" href="../RPL-Web-Library_Information_System/admin-mode/bootstrap/css/bootstrap.min.css">

</head>
<body>
<header>
    <h2 class="p-3">
        <div> 
            <!--Tombol untuk kembali ke halaman awal-->
            <a href="index.php" style="float: right; ">
            <button type="submit" class="btn btn-danger ">Kembali</button></a>
        </div>
        <center>Sistem Administrasi Penitipan Barang Selasa Akur</center>
    </h2>
</header>
<main>
    <div class="container">
    <?php
        $kode = $_GET['kode'];
        
        include 'database.php';
        $db = new Database();
        //menampilkan data dari setiap kode penitipan yng dilihat detailnya
        foreach ($db->tampildatamem($kode) as $data) { ?>
            <div class="card p-4 bg-light" style="margin-left:10rem; width: 50rem">
            <table class=" table table-striped">
                <tr >
                    <td> No KTP </td>
                    <td>: <?=$data['idpenitip']?> </td>
                </tr>
                <tr>
                    <td> Nama Penitip </td>
                    <td>: <?=$data['namapenitip']?> </td>
                </tr>
                <tr>
                    <td> HP / No Telp </td>
                    <td>: <?=$data['notelp']?> </td>
                </tr>
                <tr>
                    <td> Jenis Barang </td>
                    <td>: <?=$data['namabarang']?> </td>
                </tr>
                <tr>
                    <td> Jumlah Barang </td>
                    <td>: <?=$data['jlhbarang']?> </td>
                </tr>
                <tr>
                    <td> Tanggal Titip </td>
                    <td>: <?=$data['tgltitip']?> </td>
                </tr>
                <?php
                    //tanggal ambil dtampilkan jika barang sudah diambil
                    if ($data['tglambil'] == '0000-00-00') {
                        $status = 'Belum Diambil';
                    } else {
                        $status = 'Sudah Diambil'; ?>
                        <tr>
                            <td> Tanggal Ambil </td>
                            <td>: <?=$data['tglambil']?> </td>
                        </tr>
                        <?php
                    }
                ?>
                <tr>
                    <td> Status Pengambilan </td>
                    <td>: <?=$status?></td>
                </tr>
            </table>
            </div>
        <?php
        }
    ?>
    </div>
</main>
</body>
</html>