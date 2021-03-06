<?php
include_once("custom.php");
include_once("TCPDF/tcpdf.php");

$account = $_GET['account'];
$gameno = $_GET['gameno'];
output($account, $gameno);

function output($account, $gameno) {
	$mysql = mysqli_connect("localhost", "NTUcup", "0986036999");
	mysqli_query($mysql, "SET NAMES utf8");
	mysqli_select_db($mysql, "tournament");
	$name = getGamename($account, $gameno);
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	$pdf->SetFont('msungstdlight', 'B', 16);

	$count = 0;
	$sql = mysqli_query($mysql, "SELECT * FROM GAMESTATE WHERE USERNO='$account' AND GAMENO='$gameno' AND PLAYNO!='NULL'");
	$num_row = mysqli_num_rows($sql);
	$modulo  = $num_row % 3;
	$stride  = ceil($num_row / 3); 

	while ($count < $num_row) {
		// Calculate the row num
		$get_row = floor($count / 3) + 1;
		if($count % 3 == 1){
			$get_row = $get_row + $stride;
		}
		if($count % 3 == 2){
			if($modulo == 1){
				$get_row = $get_row + (2 * $stride - 1);
			}
			else{
				$get_row = $get_row + 2 * $stride;
			}
		}
		// Get the row $get_row
		$sql = mysqli_query($mysql, "SELECT * FROM GAMESTATE WHERE USERNO='$account' AND GAMENO='$gameno' AND PLAYNO!='NULL' AND PLAYNO='$get_row'");
		$fetch = mysqli_fetch_array($sql);
		
		if ($count % 3 == 0) {
			$pdf->AddPage();
		}
		$count += 1;
		$playtime = empty($fetch['PLAYTIME']) ? '_____' : $fetch['PLAYTIME'];
		$playtype = getPlaytype($account, $gameno);
		if ($playtype == 'A') {
			$query1 = queryContentSingle($account, $gameno, $fetch['ABOVE']);
			$query2 = queryContentSingle($account, $gameno, $fetch['BELOW']);
			$tbl = '<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr nobr="true">
			<td>'.$name.' 第 '.$fetch['PLAYNO'].' 場次<br>第 __ 場地 時間 <u>'.$playtime.'</u></td>
			<td>'.$query1['unit'].'  '.$query1['name'].'</td>
			<td>'.$query2['unit'].'  '.$query2['name'].'</td>
			</tr>';
		}
		elseif ($playtype == 'B') {
			$query1 = queryContentDouble($account, $gameno, $fetch['ABOVE']);
			$query2 = queryContentDouble($account, $gameno, $fetch['BELOW']);
			$tbl = '<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr nobr="true">
			<td>'.$name.' 第 '.$fetch['PLAYNO'].' 場次<br>第 __ 場地 時間 <u>'.$playtime.'</u></td>
			<td>'.$query1['unitu'].'  '.$query1['nameu'].'<br>'.$query1['unitd'].'  '.$query1['named'].'</td>
			<td>'.$query2['unitu'].'  '.$query2['nameu'].'<br>'.$query2['unitd'].'  '.$query2['named'].'</td>
			</tr>';
		}
		elseif ($playtype == 'C') {
			$query1 = queryContentGroup($account, $gameno, $fetch['ABOVE']);
			$query2 = queryContentGroup($account, $gameno, $fetch['BELOW']);
			$tbl = '<table border="1" cellpadding="2" cellspacing="2" align="center">
			<tr nobr="true">
			<td>'.$name.' 第 '.$fetch['PLAYNO'].' 場次<br>第 __ 場地 時間 <u>'.$playtime.'</u></td>
			<td>'.$query1.'</td>
			<td>'.$query2.'</td>
			</tr>';
		}
		$tbl .= '<tr nobr="true"><td>得分<br></td><td></td><td></td></tr><tr nobr="true"><td>勝方簽名<br></td><td></td><td></td></tr><tr nobr="true"><td>裁判簽名<br></td><td colspan="2"></td></tr></table><br><br>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
	}
	ob_end_clean();
	$pdf->Output('output.pdf', 'D');
}
