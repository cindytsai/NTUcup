<?
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] != 'Y'){
    ?>
    <script>
        alert('您無權限觀看此頁面');
        location.replace("index.html");
    </script>
    <?
}
$db = mysql_connect('localhost', 'root', '');
mysql_query("SET NAMES 'utf8'");
mysql_select_db('NTUcup', $db);
$payMS = safe($_POST['MS']);
$payWS = safe($_POST['WS']);
$payMD = safe($_POST['MD']);
$payWD = safe($_POST['WD']);
$payXD = safe($_POST['XD']);
$payG = safe($_POST['G']);

$countMS = count($payMS);
for($i = 0; $i < $countMS; $i++){
	$MS = $payMS[$i];
	mysql_query("UPDATE MS SET PAYSTAT=1 WHERE NUM=$MS");
}
$countWS = count($payWS);
for($i = 0; $i < $countWS; $i++){
	$WS = $payWS[$i];
	mysql_query("UPDATE WS SET PAYSTAT=1 WHERE NUM=$WS");
}
$countMD = count($payMD);
for($i = 0; $i < $countMD; $i++){
	$MD = $payMD[$i];
	mysql_query("UPDATE MD SET PAYSTAT=1 WHERE NUM=$MD");
}
$countWD = count($payWD);
for($i = 0; $i < $countWD; $i++){
	$WD = $payWD[$i];
	mysql_query("UPDATE WD SET PAYSTAT=1 WHERE NUM=$WD");
}
$countXD = count($payXD);
for($i = 0; $i < $countXD; $i++){
	$XD = $payXD[$i];
	mysql_query("UPDATE XD SET PAYSTAT=1 WHERE NUM=$XD");
}
$countG = count($payG);
for($i = 0; $i < $countG; $i++){
	$G = $payG[$i];
	mysql_query("UPDATE G SET PAYSTAT=1 WHERE NUM=$G");
}

function safe($value) {
	return htmlspecialchars(addslashes($value));
}
?>

<script>
	alert('成功更新繳費狀態');
	location.replace("manager.php");
</script>