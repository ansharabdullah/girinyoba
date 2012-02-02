<?php
include ("config.php");
include ("control.php");

dbconnect();

$st_tunai = 0;
$st_cek = 0;
$st_giro = 0;
$total = 0;

$laporan = array();
$res = mysql_query("SELECT p.nomor, p.nama, c.nama_tipe, t.jumlah, c.id_tipe FROM pelanggan p, tipe_pembayaran c, transaksi t WHERE p.id_pelanggan = t.id_pelanggan AND c.id_tipe = t.id_tipe");
while($get = mysql_fetch_array($res))
{
	$laporan[] = array(
		"nomor" => $get['nomor'],
		"nama" => $get['nama'],
		"cara" => $get['nama_tipe'],
		"jumlah" => $get['jumlah']
		);
	
	$tipe = $get['id_tipe'];
	if($tipe == 1)
		$st_tunai += $get['jumlah'];
	elseif($tipe == 2)
		$st_cek += $get['jumlah'];
	else
		$st_giro += $get['jumlah'];
		
	$total += $get['jumlah'];
}
?><html>
	<head>
		<title>Laporan Transaksi</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="client.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<a href="entri.php">Entri Pembayaran</a> | <a href="laporan_transaksi.php">Laporan Transaksi</a> | <a href="laporan_cekgiro.php">Laporan Cek/Giro</a><br/><br/>
			<h3>Laporan Transaksi</h3>
			<br/>
			<table cellspacing="0">
				<tr>
					<th>No. Urut</th>
					<th>No. Pelanggan</th>
					<th>Nama Pelanggan</th>
					<th>Cara Pembayaran</th>
					<th>Besar Pembayaran</th>
				</tr>
				<? $i = 1; foreach($laporan as $v): ?>
				<tr>
					<td><?=$i?></td>
					<td><?=$v['nomor']?></td>
					<td><?=$v['nama']?></td>
					<td><?=$v['cara']?></td>
					<td>Rp. <?=number_format($v['jumlah'], 2)?></td>
				</tr>
				<? $i++; endforeach; ?>
				<tr>
					<td colspan="3"></td>
					<th>Sub Total Tunai</th>
					<td>Rp. <?=number_format($st_tunai, 2)?></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<th>Sub Total Cek</th>
					<td>Rp. <?=number_format($st_cek, 2)?></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<th>Sub Total Giro</th>
					<td>Rp. <?=number_format($st_giro, 2)?></td>
				</tr>
				<tr>
					<td colspan="3"></td>
					<th>Total</th>
					<td>Rp. <?=number_format($st_tunai, 2)?></td>
				</tr>
			</table>
		</div>
	</body>
</html>