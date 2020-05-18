<?php
require('db.php');
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
echo '<meta name="viewport" content="width=device-width,initial-scale=1" />';
$kw = $_GET['kw'];
$kw_tp = $_GET['type'];
$desc  = $_GET['dc'];
echo'<p align="center">
<a href="en-cn.php">英译汉</a> | <a href="cn-en.php">汉译英</a> | <a href="search.php">单词搜索</a>
</p><hr />';
echo '
	<input id="keywords" name="keywords" type="text" size="10" value="" /> 
	<button type="submit" class="btn btn-default" onclick="jump()">搜词</button>
	<button type="submit" class="btn btn-default" onclick="jump1()">搜译</button>
	<button type="submit" class="btn btn-default" onclick="jump2()">搜号</button>
	<script>
	function jump(){
		var kw = encodeURIComponent(document.getElementById("keywords").value);
		if(!kw){alert("请输入字段");}else{
				window.location.href=\'search.php?type=en&kw=\'+kw;
		}
	}
	function jump1(){
		var kw = encodeURIComponent(document.getElementById("keywords").value);
		if(!kw){alert("请输入字段");}else{
				window.location.href=\'search.php?type=cn&kw=\'+kw;
		}
	}
	function jump2(){
		var kw = encodeURIComponent(document.getElementById("keywords").value);
		if(!kw){alert("请输入字段");}else{
				window.location.href=\'search.php?type=id&kw=\'+kw;
		}
	}
	</script>

';
if(     $kw_tp == 'cn'){
	if($desc){$result = mysql_query("SELECT * FROM ".$db_table." WHERE cn LIKE '%$kw%' ORDER BY Id DESC");}
		 else{$result = mysql_query("SELECT * FROM ".$db_table." WHERE cn LIKE '%$kw%'");}
	$Num = mysql_num_rows($result);
}
else if($kw_tp == 'en'){
	if($desc){$result = mysql_query("SELECT * FROM ".$db_table." WHERE en LIKE '%$kw%' ORDER BY Id DESC");}
		 else{$result = mysql_query("SELECT * FROM ".$db_table." WHERE en LIKE '%$kw%'");}
	$Num = mysql_num_rows($result);
}
else if($kw_tp == 'id'){
	$result = mysql_query("SELECT * FROM ".$db_table." WHERE id = '$kw'");
	$Num = mysql_num_rows($result);
}
else {exit;}


if(!$desc){echo '<button type="submit" onclick="window.location.href=\''.'search.php?type='.$kw_tp.'&kw='.$kw.'&dc=1'.'\'">反向排序</button>';}
else{{echo '<button type="submit" onclick="window.location.href=\''.'search.php?type='.$kw_tp.'&kw='.$kw.'\'">正向排序</button>';}}
echo '<pre>';
echo '--------------------------------------------'."\n";
echo 'ID番号'."\t".'| 单词'."\t".'| 中文翻译'."\n";
echo '--------------------------------------------'."\n";
for($cnt=0;$cnt<$Num;$cnt++){
	
	$data = mysql_fetch_assoc($result);
	echo $data['id']."\t| ".$data['en']."\t| ".$data['cn']."\n";
	echo '--------------------------------------------'."\n";
}
echo '</pre>';
?>
