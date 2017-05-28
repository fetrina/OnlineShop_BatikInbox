<html>
<head>
<script type="text/javascript" src="JS/jquery-1.4.2.js"></script>
<script type="text/javascript" src="JS/jquery.fusioncharts.js"></script>
</head>
<body>
	<center>
	<div><b>Total Penjualan Komputer (dalam unit)</b></div>

	<table id="myHTMLTable" border="0" align="center" cellpadding="5">
	<tr bgcolor="#FF9900"> <th>Bulan</th> <th>Total Penjualan</th></tr>
<?php
      include "fungsi_indotgl.php";
      mysql_connect("localhost", "root", "") ;
      mysql_select_db("pintar");

      $result = mysql_query("SELECT bulan, SUM(total_penjualan) as total FROM penjualan GROUP BY bulan");
      while ($data = mysql_fetch_array($result)) {
        $bulan=konversi_bulan($data[bulan]);
	       echo "<tr bgcolor='#D5F35B'>
              <td>$bulan</td>
              <td align='center'>$data[total]</td>
              </tr>";
      }
?>

	</table>
	
	<script type="text/javascript">
	$('#myHTMLTable').convertToFusionCharts({
		swfPath: "Charts/",
		type: "Pie3D",
		data: "#myHTMLTable",
		width: "400",
		height: "300",		
		dataFormat: "HTMLTable"
	});
	</script>

	</center>
</body>
</html>

