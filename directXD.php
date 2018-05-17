<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['valid'] != 'Y'){
    ?>
    <script>
        alert('您無權限觀看此頁面');
        location.replace("index.html");
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="icpn.png">
	<meta name="description" content="國立臺灣大學台大盃羽球賽報名系統">
	<meta name="author" content="國立臺灣大學羽球校隊">
	<title>國立臺灣大學台大盃羽球賽</title>
	<link href="bootstrap.min.css" rel="stylesheet">
	<link href="custom.css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
			<h1 class="center">2018台大盃羽球賽報名表-混雙</h1>
		</div>
	</header>

	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-2">
					<p>項目：<input type="text" value="混雙" readonly /></p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-2">
					<p>學號(男)：<input type="text" id="id1" onchange="check_id1()" /></p>
					<p class="text-danger" id="id1_result"></p>
					<p>姓名：<input type="text" id="name1" /></p>
					<p>系別：<input type="text" id="major1" /></p>
					<p>年級：<select id="grade1">
							<option value=""></option>
							<option value="B1">大一</option><option value="B2">大二</option>
							<option value="B3">大三</option><option value="B4">大四</option>
							<option value="B5">大五</option><option value="B6">大六</option>
							<option value="B7">大七</option><option value="R1">碩一</option>
							<option value="R2">碩二</option><option value="R3">碩三</option>
							<option value="R4">碩四</option><option value="D1">博一</option>
							<option value="D2">博二</option><option value="D3">博三</option>
							<option value="D4">博四</option><option value="D5">博五</option>
							<option value="D6">博六</option><option value="D7">博七</option>
					</select></p>
					<p>聯絡電話：<input type="text" id="phone1" /></p>
					<p>出生日期：<input class="smaller_box" type="text" id="birthy1" placeholder="西元" /> 年
						<input class="smallest_box" type="text" id="birthm1" /> 月
						<input class="smallest_box" type="text" id="birthd1" /> 日</p>
					<p>身分證字號：<input type="text" id="identity1" /></p>
				</div>
				<div class="col-sm-4">
					<p>學號(女)：<input type="text" id="id2" onchange="check_id2()" /></p>
					<p class="text-danger" id="id2_result"></p>
					<p>姓名：<input type="text" id="name2" /></p>
					<p>系別：<input type="text" id="major2" /></p>
					<p>年級：<select id="grade2">
							<option value=""></option>
							<option value="B1">大一</option><option value="B2">大二</option>
							<option value="B3">大三</option><option value="B4">大四</option>
							<option value="B5">大五</option><option value="B6">大六</option>
							<option value="B7">大七</option><option value="R1">碩一</option>
							<option value="R2">碩二</option><option value="R3">碩三</option>
							<option value="R4">碩四</option><option value="D1">博一</option>
							<option value="D2">博二</option><option value="D3">博三</option>
							<option value="D4">博四</option><option value="D5">博五</option>
							<option value="D6">博六</option><option value="D7">博七</option>
					</select></p>
					<p>聯絡電話：<input type="text" id="phone2" /></p>
					<p>出生日期：<input class="smaller_box" type="text" id="birthy2" placeholder="西元" /> 年
						<input class="smallest_box" type="text" id="birthm2" /> 月
						<input class="smallest_box" type="text" id="birthd2" /> 日</p>
					<p>身分證字號：<input type="text" id="identity2" /></p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-2">
					<button onclick="sign_up()">確定報名</button>
				</div>
			</div>
		</div>
	</section>

	<section class="footer">
		<div class="container">
			<div class="row center">
				<span><a href="https://www.facebook.com/ntubadminton2012/?fref=ts" target="_blank"><img src="facebook.png" class="small_pic" /></a></span>
				<span class="small">&copy; 2018 NTU Badminton All Rights Reserved</span>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		function check_id1() {
			var request = new XMLHttpRequest();
			request.open("POST", "service.php");
			var data = "type=XD&id=" + document.getElementById("id1").value;
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.send(data);

			request.onreadystatechange = function() {
				if (request.readyState === 4 && request.status === 200) {
					var data = JSON.parse(request.responseText);
					if (data.msg != 'ok') {
						document.getElementById("id1_result").innerHTML = data.msg;
					}
					else {
						document.getElementById("id1_result").innerHTML = "";
					}
				}
			}
		}

		function check_id2() {
			var request = new XMLHttpRequest();
			request.open("POST", "service.php");
			var data = "type=XD&id=" + document.getElementById("id2").value;
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.send(data);

			request.onreadystatechange = function() {
				if (request.readyState === 4 && request.status === 200) {
					var data = JSON.parse(request.responseText);
					if (data.msg != 'ok') {
						document.getElementById("id2_result").innerHTML = data.msg;
					}
					else {
						document.getElementById("id2_result").innerHTML = "";
					}
				}
			}
		}

		function sign_up() {
			var request = new XMLHttpRequest();
			request.open("POST", "service.php");
			var data = "new=directXD&type=XD" + 
					   "&id1=" + document.getElementById("id1").value +
					   "&id2=" + document.getElementById("id2").value +
					   "&name1=" + document.getElementById("name1").value +
					   "&name2=" + document.getElementById("name2").value +
					   "&major1=" + document.getElementById("major1").value +
					   "&major2=" + document.getElementById("major2").value +
					   "&grade1=" + document.getElementById("grade1").value +
					   "&grade2=" + document.getElementById("grade2").value +
					   "&phone1=" + document.getElementById("phone1").value +
					   "&phone2=" + document.getElementById("phone2").value +
					   "&birthy1=" + document.getElementById("birthy1").value +
					   "&birthy2=" + document.getElementById("birthy2").value +
					   "&birthm1=" + document.getElementById("birthm1").value +
					   "&birthm2=" + document.getElementById("birthm2").value +
					   "&birthd1=" + document.getElementById("birthd1").value +
					   "&birthd2=" + document.getElementById("birthd2").value +
					   "&identity1=" + document.getElementById("identity1").value +
					   "&identity_W2=" + document.getElementById("identity2").value;
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.send(data);

			request.onreadystatechange = function() {
				if (request.readyState === 4 && request.status === 200){  
					var data = JSON.parse(request.responseText);
					if (data.msg == 'ok'){
						alert('報名成功，您的編號為 ' + data.num + '。請於指定時間內繳費');
						location.replace("index.html");
					}
					else {
						alert(data.msg);
					}
				}
			}
		}
	</script>
</body>
</html>