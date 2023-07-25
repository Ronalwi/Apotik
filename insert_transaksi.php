<?php
include 'config.php';

if (isset($_POST['submit'])) {
    session_start();
    $id_transaksi = $_POST['id_transaksi'];
    $username = $_SESSION['username'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $usia = $_POST['usia'];
    $no_hp = $_POST['no_hp'];
    $obat = $_POST['obat'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total'];
    $bayar = $_POST['bayar'];

    $isStockAvailable = true;
    $isPembayaranValid = false;

    for ($i = 0; $i < count($obat); $i++) {
        $query = mysqli_query($connect, "SELECT stock FROM obat WHERE id_obat = '$obat[$i]'");
        $data = mysqli_fetch_array($query);
        if ($data['stock'] < $jumlah[$i]) {
            $isStockAvailable = false;
            break;
        }
    }

    if ($bayar >= $total_harga ) {
        $isPembayaranValid = true;
    }

    $checkquery = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    $check = mysqli_num_rows($checkquery);
    if ($check > 0) {
       echo "<script>alert('ID Transaksi sudah ada!'); window.location = 'insert_transaksi.php'</script>";
    }else {
        if ($isStockAvailable) {
            if ($isPembayaranValid) {
                $query = mysqli_query($connect, "ALTER TABLE detail_transaksi AUTO_INCREMENT = 1");
                $query = mysqli_query($connect, "INSERT INTO transaksi (id_transaksi, id_user, nama_pelanggan, tanggal_transaksi, total_harga, usia, no_hp) VALUES ('$id_transaksi', (SELECT id_user FROM user WHERE username = '$username'), '$nama_pelanggan', now(), '$total_harga', '$usia', '$no_hp')");
            
                if ($query) {
                    for ($i = 0; $i < count($obat); $i++) {
                        $query = mysqli_query($connect, "INSERT INTO detail_transaksi (id_transaksi, id_obat, jumlah_pembelian, sub_total) VALUES ('$id_transaksi', '$obat[$i]', '$jumlah[$i]', (SELECT harga_obat * '$jumlah[$i]' FROM obat WHERE id_obat = '$obat[$i]'))");
                        $query = mysqli_query($connect, "UPDATE obat SET stock = stock - '$jumlah[$i]' WHERE id_obat = '$obat[$i]'");
                    }
                    header('Location: transaksi.php');
                } else {
                   echo "<script>alert('Gagal menambahkan data!'); window.location = 'insert_transaksi.php'</script>";
                }

            } else {
                echo "<script>alert('Pembayaran tidak valid!'); window.location = 'insert_transaksi.php'</script>";
            }
        } else {
            echo "<script>alert('Stock tidak mencukupi!'); window.location = 'insert_transaksi.php'</script>";
        }  
    }
}

?>

<html>
    <head>
        <title>Form Tambah Transaksi</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body>
    <?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

    include 'sidebar.php';
  ?>

  <div class="content">

        <h1>Tambah Transaksi</h1>
        <form method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Id Transaksi</td>
                    <td><input type="text" name="id_transaksi" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama_pelanggan" required></td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td><input type="text" name="usia" required></td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td><input type="text" name="no_hp" required></td>
                </tr>
                                       
                    </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                
                </tr>
            </table>
            <table border="1">
                <tr>
                    <th>Obat</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $query = mysqli_query($connect, "SELECT * FROM transaksi");
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td>
                            <select onchange='UpdateTable()' name="obat[]">
                                <option value='0'>Pilih Obat</option>
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM obat");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_obat'] ?>"><?php echo $data['nama_obat'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type='text' name='stok[]' readonly></td>
                        <td><input type='text' name='harga[]' readonly></td>
                        <td><input type='text' name='jumlah[]'></td>
                        <td><input type='text' name='subtotal[]' readonly></td>
                        <td>
                            <button onclick='HapusObat()' type="button" class="delete">Hapus</button>
                        </td>
                    </tr>
                    <tr id='form_row'></tr>

                    <tr>
                        <td colspan="4" align="right">Total</td>
                        <td><input type="text" name="total" readonly></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td colspan="4" align="right">Bayar</td>
                        <td><input type="text" name="bayar" onkeyup='HitungKembalian()'></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td colspan="4" align="right">Kembali</td>
                        <td><input type="text" name="kembali" readonly></td>
                        <td>&nbsp;</td>
                    </tr>

                    <?php
                }
                ?>
                </table>
        <button onclick='TambahObat()' type="button" name="button" value="insert">Tambah Obat</button>
        <input type="submit" name="submit" value="Simpan">
        </form>
        </div>

        <script>
            function TambahObat() {
                var form_row = document.getElementById('form_row');
                var tr = document.createElement('tr');
                
                tr.innerHTML=`<td>
                            <select onchange='UpdateTable()' name="obat[]">
                                <option value='0'>Pilih Obat</option>
                                <?php
                                include ("config.php");
                                $query = mysqli_query($connect, "SELECT * FROM obat");
                                while($data = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $data['id_obat'] ?>"><?php echo $data['nama_obat'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type='text' name='stok[]' readonly></td>
                        <td><input type='text' name='harga[]' readonly></td>
                        <td><input type='text' name='jumlah[]'></td>
                        <td><input type='text' name='subtotal[]' readonly></td>
                        <td>
                            <button onclick='HapusObat()' type="button" class="delete">Hapus</button>
                        </td>`;
                form_row.parentNode.insertBefore(tr, form_row.nextElementSibling);
                UpdateTable();
                
            }

            function HapusObat() {
                var buttons = document.getElementsByClassName('delete');
                function handleCLick(event) {
                    var buttonIndex = Array.from(buttons).indexOf(event.target);
                    buttons[buttonIndex].parentNode.parentNode.remove();
                    console.log(buttonIndex);
                }
                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener('click', handleCLick);
                }
                UpdateTable();
            }

            function UpdateTable() {
                var obat = document.getElementsByName('obat[]');
                var stok = document.getElementsByName('stok[]');
                var harga = document.getElementsByName('harga[]');
                var jumlah = document.getElementsByName('jumlah[]');
                var subtotal = document.getElementsByName('subtotal[]');
                var total = document.getElementsByName('total');
                var bayar = document.getElementsByName('bayar');
                var kembali = document.getElementsByName('kembali');

                var total_harga = 0;
                for (var i = 0; i < obat.length; i++) {
                    if (obat[i].value!=0) {
                        <?php
                        include ("config.php");
                        $query = mysqli_query($connect, "SELECT * FROM obat");
                        while($data = mysqli_fetch_array($query)){
                        ?>
                            if (obat[i].value == <?php echo $data['id_obat'] ?>) {
                                stok[i].value = <?php echo $data['stock'] ?>;
                                harga[i].value = <?php echo $data['harga_obat'] ?>;
                                subtotal[i].value = jumlah[i].value != '' && jumlah[i].value!=0 ? parseInt( jumlah[i].value) * <?php echo $data['harga_obat']; ?> : 0;
                            }
                        <?php } ?>
                    } else {
                        stok[i].value = 0;
                        harga[i].value = 0;
                        subtotal[i].value = 0;
                        jumlah[i].value = 0;
                        document.getElementsByName('total')[0].value = 0;
                    }
                }
                document.getElementsByName('total')[0].value = HitungTotal();
                HitungKembalian();
                EventListener();
            }

            function HitungTotal() {
                var subtotal=document.getElementsByName('subtotal[]');
                var total=0;
                for (var i = 0; i < subtotal.length; i++) {
                    total += parseInt(subtotal[i].value);
                }
                return total;
            }

            function EventListener() {
                for (var i=0; i<document.getElementsByName('jumlah[]').length; i++) {
                    document.getElementsByName('jumlah[]')[i].addEventListener('keyup', UpdateTable);
                }
            }

            function HitungKembalian() {
                var total = document.getElementsByName('total')[0].value;
                var bayar = document.getElementsByName('bayar')[0].value;
                var kembali = document.getElementsByName('kembali')[0];
                kembali.value = bayar - total;
            }

            EventListener();
            UpdateTable();

        </script>
        </div>

    </body>
</html>