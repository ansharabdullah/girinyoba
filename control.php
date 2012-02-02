<?php
function control_tanggal($nama, $default_y = "", $default_m = "", $default_d = "")
{
	if($default_y == "") $default_y = date("Y");
	if($default_m == "") $default_m = date("m");
	if($default_d == "") $default_d = date("d");

	print '<select name="' . $nama . '_d">';
	for($i = 1; $i <= 31; $i++)
	{
		$si = ($i < 10) ? "0" . $i : $i;
		if($i == $default_d)
			print '<option value="' . $si . '" selected="selected">' . $i . '</option>';
		else
			print '<option value="' . $si . '">' . $i . '</option>';
	}
	print '</select>';
	
	print '<select name="' . $nama . '_m">';
	for($i = 1; $i <= 12; $i++)
	{
		$si = ($i < 10) ? "0" . $i : $i;
		if($i == $default_m)
			print '<option value="' . $si . '" selected="selected">' . $i . '</option>';
		else
			print '<option value="' . $si . '">' . $i . '</option>';
	}
	print '</select>';
	
	print '<select name="' . $nama . '_y">';
	for($i = date("Y") - 1; $i <= date("Y") + 1; $i++)
	{
		if($i == $default_y)
			print '<option value="' . $i . '" selected="selected">' . $i . '</option>';
		else
			print '<option value="' . $i . '">' . $i . '</option>';
	}
	print '</select>';
}
?>