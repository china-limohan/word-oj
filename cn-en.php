<?php
require('db.php');
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
echo '<meta name="viewport" content="width=device-width,initial-scale=1" />';
$id  = $_GET['id'];
$ans = $_POST['answer'];

if(!$id){
	echo '
		从ID=<input id="keywords" name="keywords" type="text" size="1" value="1" />开始
		<button type="submit" class="btn btn-default" onclick="jump()">转跳</button><br /><br />或者：<button type="submit" class="btn btn-default" onclick="window.location.href=\''.'cn-en.php?id='.rand(1, 3874).'\'">随机开始</button>
		<script>
		function jump(){
			var kw = encodeURIComponent(document.getElementById("keywords").value);
			if(!kw){alert("请输入字段");}else{
					window.location.href=\'cn-en.php?id=\'+kw;
			}
		}
		</script>

	';
	exit;
}
$result = mysql_query("SELECT * FROM ".$db_table." WHERE id = '$id'");
$Num = mysql_num_rows($result);
echo'<p align="center">
<a href="en-cn.php">英译汉</a> | <a href="cn-en.php">汉译英</a> | <a href="search.php">单词搜索</a>
</p><hr />';
echo '<pre>';
echo 'Translations:'."\n";
echo '--------------------------------------------'."\n";
$data = array();
for($cnt=0;$cnt<$Num;$cnt++){
	$data = mysql_fetch_assoc($result);
	echo $data['id']."\t| ".$data['cn']."\n";
}
echo '--------------------------------------------'."\n";

echo '</pre>';
if($ans){
	if($data['en'] == $ans){
		echo '<font style="color:green">[AC] Accepted!</font><br />';
	}else{
		echo '<font style="color:red">[WA] Unaccepted!</font><br />';

	}
	echo '<pre>';
	echo 'Words:'."\n";
	echo '--------------------------------------------'."\n";
	echo $data['en']."\n";
	echo '--------------------------------------------'."\n";
	echo '</pre>';

	echo '<button type="submit" onclick="window.location.href=\''.'cn-en.php?id='.$id.'\'">重新提交</button>';
	$nd = $id + 1;
	echo '<button type="submit" onclick="window.location.href=\''.'cn-en.php?id='.$nd.'\'">下一个ID</button>';
	echo '<button type="submit" onclick="window.location.href=\''.'cn-en.php?id='.rand(1, 3874).'\'">随机</button><br />';
}
else
echo '
<form class="form-horizontal" role="form" method="post" action="'.'//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">
<input type="text" name="answer" value="" size="10" />
<button type="submit">提交</button>
</form>
';

?>