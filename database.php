<?php
class Database{
    private $conn;

    public function __construct() {
        $this->conn = new mysqli ("localhost","root","","titip-barang");
        $this->conerror();
    }

    private function conerror() {
        if ($this->conn->connect_error) {
            //jika terjadi error, matikan proses dengan die() atau exit()
            die('Maaf koneksi gagal: '. $this->conn->connect_error);
        }
    } 
    
    function getcon() {
        return $this->conn;
    }

    function tampildata($view){
        //mengambil data dari database untuk ditampilkan
        include 'kripto.php';
        $kript = new Kriptografi();
        //melakukan filter terhadap data yang ditampilkan pada tabel
        if ($view == 'semua') {
            $query = mysqli_query($this->conn,"SELECT * FROM penitipan");
        } elseif ($view == 'belumdiambil') {
            $query = mysqli_query($this->conn,"SELECT * FROM penitipan WHERE tglambil = '0-0`000`00``0-``'");
        } else {
            $query = mysqli_query($this->conn,"SELECT * FROM penitipan WHERE tglambil != '0-0`000`00``0-``'");
        }
        $hasil = null;

        while($data = mysqli_fetch_array($query)){
            foreach ($data as $key => $value) {
                //melakukan dekripsi data
                if ($key != 'kodetitip' && $key != 'jlhbarang') {
                    $kript->setWord($value, 'dekripsi');
                    $data[$key] = $kript->getPlain();
                }
            }
            $hasil[] = $data;
        }
        return $hasil;
        
    }

    function tampildatamem($kodetitip){
        //mengambil data member dari database untuk ditampilkan
        include 'kripto.php';
        $kript = new Kriptografi();

        $query = mysqli_query($this->conn,"SELECT * FROM penitipan WHERE kodetitip = '$kodetitip' ");
        $hasil = null;

        while($data = mysqli_fetch_array($query)){
            foreach ($data as $key => $value) {
                if ($key != 'kodetitip' && $key != 'jlhbarang') {
                    $kript->setWord($value, 'dekripsi');
                    $data[$key] = $kript->getPlain();
                }
            }
            $hasil[] = $data;
        }
        return $hasil;
        
    }

    function inputtitip($idp, $namap, $notelp, $namab, $jlhb, $tgltitip, $tglambil){
        //menambahkan data kedalam database
        mysqli_query($this->conn,"INSERT INTO penitipan VALUES('','$idp','$namap','$notelp','$namab','$jlhb','$tgltitip','$tglambil')");
    }  

    function inputambil($kodetitip, $date) {
        //menambahkan data tanggal pengambilan kedalam database
        mysqli_query($this->conn,"UPDATE penitipan SET tglambil='$date' WHERE kodetitip='$kodetitip' ");
    }

    function cekpassadm($idadm, $passadm) {
        //melakukan pengecekan terhadap admin id dan password 
        $data = mysqli_query($this->conn,"SELECT * FROM `admin` WHERE `kodeadm`=MD5('$idadm') AND passwordadm=MD5('$passadm') ");
        $data = mysqli_num_rows($data);
        return $data;
    }

    function countdata() {
        //menghitung data kosong atau tidak
        $data = mysqli_query($this->conn,"SELECT * FROM penitipan ");
        $data = mysqli_num_rows($data);
        return $data;
    }
}

?>