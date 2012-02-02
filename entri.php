<?php
include ("config.php");
include ("control.php");

dbconnect();

$cara_pembayaran = array();
$res = mysql_query("SELECT * FROM tipe_pembayaran");
while($get = mysql_fetch_array($res))
	$cara_pembayaran[$get['id_tipe']] = $get['nama_tipe'];

$berhasil = false;
$sisa = 0;
if($_POST['entri'] == "true")
{
	$nomor = htmlentities($_POST['nomor']);
	$tanggal_d = htmlentities($_POST['tanggal_d']);
	$tanggal_m = htmlentities($_POST['tanggal_m']);
	$tanggal_y = htmlentities($_POST['tanggal_y']);
	$pembayaran = htmlentities($_POST['pembayaran']);
	$jumlah = htmlentities($_POST['jumlah']);
	
	// Cek/Giro
	$nama_bank = htmlentities($_POST['nama_bank']);
	$nomor_cek_giro = htmlentities($_POST['nomor_cek_giro']);
	$jatuh_tempo_d = htmlentities($_POST['jatuh_tempo_d']);
	$jatuh_tempo_m = htmlentities($_POST['jatuh_tempo_m']);
	$jatuh_tempo_y = htmlentities($_POST['jatuh_tempo_y']);
	
	$res = mysql_query("SELECT id_pelanggan, hutang FROM pelanggan WHERE nomor = '" . $nomor . "'");
	$get = mysql_fetch_array($res);
	$id_pelanggan = $get['id_pelanggan'];
	$sisa = $get['hutang'] - $jumlah;
	
	if($pembayaran == 1)
	{
		mysql_query(sprintf("INSERT INTO transaksi (id_pelanggan, id_tipe, jumlah, tanggal_bayar) VALUES (%d, %d, %d, '%s');", $id_pelanggan, $pembayaran, $jumlah, $tanggal_y . "-" . $tanggal_m . "-" . $tanggal_d));
	
		$berhasil = true;
	}
	else
	{
		mysql_query(sprintf("INSERT INTO transaksi (id_pelanggan, id_tipe, jumlah, tanggal_bayar, nama_bank, nomor_cek_giro, tanggal_jatuh_tempo) VALUES (%d, %d, %d, '%s', '%s', '%s', '%s');", $id_pelanggan, $pembayaran, $jumlah, $tanggal_y . "-" . $tanggal_m . "-" . $tanggal_d, $nama_bank, $nomor_cek_giro, $jatuh_tempo_y . "-" . $jatuh_tempo_m . "-" . $jatuh_tempo_d));
	
		$berhasil = true;
	}
	
	mysql_query("UPDATE pelanggan SET hutang = " . $sisa . " WHERE id_pelanggan = " . $id_pelanggan);
}
?><html>
	<head>
		<title>Entri Pembayaran</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="client.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<a href="entri.php">Entri Pembayaran</a> | <a href="laporan_transaksi.php">Laporan Transaksi</a> | <a href="laporan_cekgiro.php">Laporan Cek/Giro</a><br/><br/>
			
			<h3>Entri Pembayaran</h3>
			<br/>
		
			<? if($berhasil): ?>
			<b>Hore Berhasil, sisa hutang adalah Rp. <?=number_format($sisa, 2)?></b>
			<? endif; ?>
			<form action="" method="post">
				<input type="hidden" name="entri" value="true" />
				<table class="form">
					<tr>
						<th>Nomor Pelanggan</th>
						<td><input type="text" name="nomor" maxlength="5" size="10" /></td>
					</tr>
					<tr>
						<th>Tanggal Pembayaran</th>
						<td><?=control_tanggal("tanggal")?></td>
					</tr>
					<tr>
						<th>Cara Pembayaran</th>
						<td><select name="pembayaran" onchange="toggle_giro(this.selectedIndex);">
						<? foreach($cara_pembayaran as $k => $v): ?>
							<option value="<?=$k?>"><?=$v?></option>
						<? endforeach; ?>
						</select></td>
					</tr>
					<tr>
						<th>Besar Pembayaran</th>
						<td>Rp. <input type="text" name="jumlah" maxlength="11" size="15" value="0" /></td>
					</tr>
				</table>
				<div id="cekgiro" style="display: none">
				<table class="form">
					<tr>
						<th>Nama Bank</th>
						<td><input type="text" name="nama_bank" maxlength="50" size="30" /></td>
					</tr>
					<tr>
						<th>Nomor Cek/Giro</th>
						<td><input type="text" name="nomor_cek_giro" maxlength="25" size="25" /></td>
					</tr>
					<tr>
						<th>Tanggal Jatuh Tempo</th>
						<td><?=control_tanggal("jatuh_tempo")?></td>
					</tr>
				</table>
				</div>
				
				<input type="submit" value="Submit" />
			</form>
		</div>
	</body>
</html>