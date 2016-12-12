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
function transfer_grade($grade) {
    if ($grade == 'B1') {return '大一';}
    else if ($grade == 'B2') {return '大二';}
    else if ($grade == 'B3') {return '大三';}
    else if ($grade == 'B4') {return '大四';}
    else if ($grade == 'B5') {return '大五';}
    else if ($grade == 'B6') {return '大六';}
    else if ($grade == 'B7') {return '大七';}
    else if ($grade == 'R1') {return '碩一';}
    else if ($grade == 'R2') {return '碩二';}
    else if ($grade == 'R3') {return '碩三';}
    else if ($grade == 'D1') {return '博一';}
    else if ($grade == 'D2') {return '博二';}
    else if ($grade == 'D3') {return '博三';}
    else if ($grade == 'D4') {return '博四';}
    else if ($grade == 'D5') {return '博五';}
    else if ($grade == 'D6') {return '博六';}
    else if ($grade == 'D7') {return '博七';}
}
function check_paystat($value) {
    if ($value == '1'){
        return ' checked disabled';
    }
}
$db = mysql_connect('localhost', 'root', '');
mysql_query("SET NAMES 'utf8'");
mysql_select_db('NTUcup', $db);
$queryMS = mysql_query("SELECT * FROM MS");
$numMS = mysql_num_rows($queryMS);
$queryWS = mysql_query("SELECT * FROM WS");
$numWS = mysql_num_rows($queryWS);
$queryMD = mysql_query("SELECT * FROM MD");
$numMD = mysql_num_rows($queryMD);
$queryWD = mysql_query("SELECT * FROM WD");
$numWD = mysql_num_rows($queryWD);
$queryXD = mysql_query("SELECT * FROM XD");
$numXD = mysql_num_rows($queryXD);
$queryG = mysql_query("SELECT * FROM G");
$numG = mysql_num_rows($queryG);
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="icon.png">
    <meta name="description" content="國立臺灣大學台大盃羽球賽報名系統">
    <meta name="author" content="國立臺灣大學羽球校隊">
    <title>國立臺灣大學台大盃羽球賽</title>
    <link href="custom.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="center">更新繳費狀態</h1>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 center">
                <div class="panel-group" id="accordion">
                    <br>
                    <form method="post" action="pay_update.php">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h4 class="panel-title">男單</h4></a>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    while ($result = mysql_fetch_array($queryMS)){
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR'].transfer_grade($result['GRADE']).'</td><td>'.$result['NAME'].'</td><td><input type="checkbox" name="MS[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><h4 class="panel-title">女單</h4></a>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    $count = 0;
                                    while ($result = mysql_fetch_array($queryWS)){
                                        $count += 1;
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR'].transfer_grade($result['GRADE']).'</td><td>'.$result['NAME'].'</td><td><input type="checkbox" name="WS[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><h4 class="panel-title">男雙</h4></a>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    $count = 0;
                                    while ($result = mysql_fetch_array($queryMD)){
                                        $count += 1;
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].transfer_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].transfer_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="MD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><h4 class="panel-title">女雙</h4></a>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    $count = 0;
                                    while ($result = mysql_fetch_array($queryWD)){
                                        $count += 1;
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].transfer_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].transfer_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="WD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><h4 class="panel-title">混雙</h4></a>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>系級</th>
                                        <th>姓名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    $count = 0;
                                    while ($result = mysql_fetch_array($queryXD)){
                                        $count += 1;
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].transfer_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].transfer_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="XD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6"><h4 class="panel-title">團體</h4></a>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table border="2" width="100%">
                                    <tr>
                                        <th>編號</th>
                                        <th>系所</th>
                                        <th>隊名</th>
                                        <th>繳費</th>
                                    </tr>
                                    <?
                                    while ($result = mysql_fetch_array($queryG)){
                                        echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['Gmajor'].'</td><td>'.$result['Gname'].'</td><td><input type="checkbox" name="G[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).' /></td></tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="確定更新" />
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="center"><a href="manager.php"><button>返回</button></a></div>
    </div>

    <section class="footer">
        <div class="container">
            <div class="row center">
                <span><a href="https://www.facebook.com/ntubadminton2012/?fref=ts" target="_blank"><img src="facebook.png" class="small_pic" /></a></span>
                <span class="small">&copy; 2016 NTU Badminton All Rights Reserved</span>
            </div>
        </div>
    </section>
</body>
</html>