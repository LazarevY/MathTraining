<?php
session_name();
session_start();
$nick = $_SESSION['nickName'];
	if(isset($_POST['mode'])){
		$mode = $_POST['mode'];
        $s_mode = "s_" . $mode;
        $level = $_POST['level'];
        include("../../php_scripts/DB_connect.php");
        $query = mysqli_query($db, "SELECT $s_mode FROM levels WHERE level='$level'");
        $query = mysqli_fetch_array($query);
        $list = explode("/", $query[$s_mode]);
        $list[0] = (int)$list[0];
        $list[1] = (int)$list[1];
        $min = $list[0];
        $max = $list[1];
		$operator = "";
		switch($mode){
			case "add":
				$operator = "+";
				break;
			case "sub":
				$operator = "-";
				break;
			case "mult":
				$operator = "*";
				break;
			case "sqr":
				$operator = "^";	
				break;
			case "div":
				$operator = "/";
		}
		
echo <<<HERE
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Action</title>
    <link rel="stylesheet" type="text/css" href="action.css">
</head>
<body onload="start_training();" onbeforeunload="document.location.replace('../../php_scripts/set_statistic.php?mode='+'$mode'+'&right='+$('#right').text()+'&all='+$('#all').text()+'&');">
<div class="main_container">
    <div class="user_bar">
        <div class="user_info">
            <div style="width: 65%; float: left; height: 100%;
        line-height: 100%;">User : $nick
            </div>
            <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');"
                   value="Выйти"></div>
    </div>
    <div class="content">
            <div style="height: 30%; width: 100%; background-color: rgba(6,2,255,0.6)">
            <table style="color: aliceblue">
                <tbody>
                    <tr>
                        <td>Решено правильно</td>
                        <td>Всего решено</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><p id="right">0</p></td>
                        <td style="text-align: center"><p id="all">0</p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="expression" id="tb">
            <tr>
                <td style="text-align: right; width: 48%"><p class="operand" id="first_operand"></p></td>
                <td style="width: 4%"><p class="operand" id="operator">&nbsp;$operator&nbsp;</p></td>
                <td style="text-align: left; width: 48%"><p class="operand" id="second_operand"></p></td>
            </tr>
            <tr>
                <td colspan="3"><label for="answer"></label><input autofocus="on" type="number"
                                                                   name="ans" class="answer_input" id="answer"
                                                                   onkeydown="key_action('$mode','first_operand',
                                                                   'second_operand','answer', 'right','all');"/>
                </td>
            </tr>
        </table>
        <input type = "hidden" name = "min_value" id = "min" value = "$min" />
        <input type = "hidden" name = "max_value" id = "max" value = "$max" />
        <input type = "hidden"  id = "current_mode" value = "$mode" />
    </div>
    <div class="clear"></div>
    <div class="bottom">
    <input type="button" onclick="document.location.replace('../../php_scripts/set_statistic.php?mode='+'$mode'+'&right='+$('#right').text()+'&all='+$('#all').text()+'&');" value="Завершить"/>
</div>
</div>
<script type="text/javascript" src="../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src="../../javascripts/size_control.js"></script>
<script>set_sizes('main_container')</script>
<script type="text/javascript" src="../../javascripts/scripts.js"></script>
<script type="text/javascript" src="../../javascripts/functions.js"></script>
</body>
</html>
HERE;
}?>
