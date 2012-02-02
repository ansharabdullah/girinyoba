<?php
include ("config.php");
include ("control.php");

dbconnect();

$total = 0;

$date1 = date("Y-m-d");
$date2 = $date1;
$jenis = 2;

if($_POST['cekgiro'] == "true")
{
	$date1 = $_POST['date1_y'] . "-" . $_POST['date1_m'] . "-" . $_POST['date1_d'] . "-";
	$date2 = $_POST['date2_y'] . "-" . $_POST['date2_m'] . "-" . $_POST['date2_d'] . "-";
	$jenis = $_POST['jenis'];
}

$laporan = array();

if($date1 == $date2)
	$query = "SELECT nomor_cek_giro, nama_bank, jumlah, tanggal_jatuh_tempo FROM transaksi WHERE id_tipe = " . $jenis . " AND tanggal_jatuh_tempo = '" . $date1 . "' ORDER BY tanggal_jatuh_tempo ASC";
else
	$query = "SELECT nomor_cek_giro, nama_bank, jumlah, tanggal_jatuh_tempo FROM transaksi WHERE id_tipe = " . $jenis . " AND tanggal_jatuh_tempo BETWEEN '" . $date1 . "' AND '" . $date2 . "' ORDER BY tanggal_jatuh_tempo ASC";

$res = mysql_query($query);
while($get = mysql_fetch_array($res))
{
	$jtx = explode("-", $get['tanggal_jatuh_tempo']);
	$jty = $jtx[0];
	$jtm = $jtx[1];
	$jtd = $jtx[2];

	$yad = (int)((mktime (0, 0, 0, $jtm, $jtd, $jty) - time(void))/86400); ;
	$laporan[] = array(
		"nomor" => $get['nomor_cek_giro'],
		"nama" => $get['nama_bank'],
		"jumlah" => $get['jumlah'],
		"tanggal" => $get['tanggal_jatuh_tempo'],
		"yad" => $yad
		);
		
	$total += $get['jumlah'];
}
?><html>
	<head>
		<title>Laporan Cek/Giro</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="client.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<a href="entri.php">Entri Pembayaran</a> | <a href="laporan_transaksi.php">Laporan Transaksi</a> | <a href="laporan_cekgiro.php">Laporan Cek/Giro</a><br/><br/>
			<h3>Laporan Cek/Giro</h3>
			<br/>
			<form action="" method="post">
				<input type="hidden" name="cekgiro" value="true" />
				<b>Tanggal:</b> <?=control_tanggal("date1", $_POST['date1_y'], $_POST['date1_m'], $_POST['date1_d'])?> sampai <?=control_tanggal("date2", $_POST['date2_y'], $_POST['date2_m'], $_POST['date2_d'])?><br/>
				<b>Jenis Pembayaran:</b> <select name="jenis">
				<option value="2"<? if($jenis == 2): ?> selected="selected"<? endif; ?>>Cek</option>
				<option value="3"<? if($jenis == 3): ?> selected="selected"<? endif; ?>>Giro</option>
				</select>
			<input type="submit" value="Submit" />
			</form>
			<br/>
			<table cellspacing="0">
				<tr>
					<th>Nomor Cek/Giro</th>
					<th>Bank</th>
					<th>Nilai</th>
					<th>Jatuh Tempo</th>
					<th>Berapa Hari YAD</th>
				</tr>
				<? foreach($laporan as $v): ?>
				<tr>
					<td><?=$v['nomor']?></td>
					<td><?=$v['nama']?></td>
					<td>Rp. <?=number_format($v['jumlah'], 2)?></td>
					<td><?=$v['tanggal']?></td>
					<td><?=$v['yad']?>
				</tr>
				<? endforeach; ?>
				<tr>
					<td colspan="3"></td>
					<th>Total</th>
					<td><?=$total?></td>
				</tr>
			</table>
		</div>
	</body>
</html>