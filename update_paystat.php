<?php
$mysql = mysqli_connect('localhost', 'root', '');
mysqli_query($mysql, "SET NAMES 'utf8'");
mysqli_select_db($mysql, 'NTUcup');

function translate_grade($grade) {
    if ($grade == 'B1') return '大一';
    elseif ($grade == 'B2') return '大二';
    elseif ($grade == 'B3') return '大三';
    elseif ($grade == 'B4') return '大四';
    elseif ($grade == 'B5') return '大五';
    elseif ($grade == 'B6') return '大六';
    elseif ($grade == 'B7') return '大七';
    elseif ($grade == 'R1') return '碩一';
    elseif ($grade == 'R2') return '碩二';
    elseif ($grade == 'R3') return '碩三';
    elseif ($grade == 'R4') return '碩四';
    elseif ($grade == 'D1') return '博一';
    elseif ($grade == 'D2') return '博二';
    elseif ($grade == 'D3') return '博三';
    elseif ($grade == 'D4') return '博四';
    elseif ($grade == 'D5') return '博五';
    elseif ($grade == 'D6') return '博六';
    elseif ($grade == 'D7') return '博七';
}

function check_paystat($value) {
    if ($value == '1') return ' checked disabled';
}

$queryMS = mysqli_query($mysql, "SELECT * FROM MS");
$numMS = ($queryMS == false) ? 0 : mysqli_num_rows($queryMS);
$queryWS = mysqli_query($mysql, "SELECT * FROM WS");
$numWS = ($queryWS == false) ? 0 : mysqli_num_rows($queryWS);
$queryMD = mysqli_query($mysql, "SELECT * FROM MD");
$numMD = ($queryMD == false) ? 0 : mysqli_num_rows($queryMD);
$queryWD = mysqli_query($mysql, "SELECT * FROM WD");
$numWD = ($queryWD == false) ? 0 : mysqli_num_rows($queryWD);
$queryXD = mysqli_query($mysql, "SELECT * FROM XD");
$numXD = ($queryXD == false) ? 0 : mysqli_num_rows($queryXD);
$queryG = mysqli_query($mysql, "SELECT * FROM G");
$numG = ($queryG == false) ? 0 : mysqli_num_rows($queryG);
?>
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
                                    <?php
                                    if (!$queryMS) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系級</th><th>姓名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryMS)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR'].translate_grade($result['GRADE']).'</td><td>'.$result['NAME'].'</td><td><input type="checkbox" name="MS[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
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
                                    <?php
                                    if (!$queryWS) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系級</th><th>姓名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryWS)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR'].translate_grade($result['GRADE']).'</td><td>'.$result['NAME'].'</td><td><input type="checkbox" name="WS[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
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
                                    <?php
                                    if (!$queryMD) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系級</th><th>姓名</th><th>系級</th><th>姓名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryMD)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].translate_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].translate_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="MD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
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
                                    <?php
                                    if (!$queryWD) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系級</th><th>姓名</th><th>系級</th><th>姓名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryWD)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].translate_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].translate_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="WD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
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
                                    <?php
                                    if (!$queryXD) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系級</th><th>姓名</th><th>系級</th><th>姓名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryXD)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['MAJOR_1'].translate_grade($result['GRADE_1']).'</td><td>'.$result['NAME_1'].'</td><td>'.$result['MAJOR_2'].translate_grade($result['GRADE_2']).'</td><td>'.$result['NAME_2'].'</td><td><input type="checkbox" name="XD[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
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
                                    <?php
                                    if (!$queryXD) {
                                        echo "目前尚無選手報名";
                                    }
                                    else {
                                        echo "<tr><th>編號</th><th>系所</th><th>隊名</th><th>繳費</th></tr>";
                                        while ($result = mysqli_fetch_array($queryXD)){
                                            echo '<tr><td>'.$result['NUM'].'</td><td>'.$result['Gmajor'].'</td><td>'.$result['Gname'].'</td><td><input type="checkbox" name="G[]" value="'.$result['NUM'].'"'.check_paystat($result['PAYSTAT']).'></td></tr>';
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="確定更新">
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="center"><a href="index.php?route=manager"><button>返回</button></a></div>
    </div>