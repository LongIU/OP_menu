<?php
session_start();
	$dbType   = 'mysql';
	$host     = '127.0.0.1'; //此处不用localhost
	$dbName   = 'op_menu';
	$userName = 'root';
	$pwd      = 'qwe123';
 
	$dsn = "$dbType:host=$host;dbname=$dbName";
    try {
		$pdo = new PDO($dsn, $userName, $pwd);
		//echo '连接成功';		
	} catch (PDOException $e) {
		echo '连接失败：' . $e->getMessage();
	}

if (preg_match("/^[A-Z_\-a-z0-9]+$/u", $_POST["myname"])) {
    /* //寫入txt檔案的機制
	$myfile = fopen("txt/{$_POST['myname']}", "a+") or die("Unable to file!");
    $txt = "{$_POST['menu']}|{$_POST['url_name']}\n";
    fwrite($myfile, $txt);
    fclose($myfile);*/
	
	//DB機制
	 $sth = "INSERT INTO `menu_table` SET 
		`Main_name` = '{$_POST['myname']}',
		`Sub_name` = '{$_POST['menu']}',
		`url` = '{$_POST['url_name']}'";
	 $count = $pdo->exec($sth);
	 //echo $count;
	 header('location:fwrite.php?check=OK');
} elseif ($_GET['check'] == 'OK'){
    echo '新增成功'; 	
} else {
	echo "{$_POST["myname"]}包含不允許字元，加入失敗";
}

$rs = $pdo->query("SELECT * FROM menu_table");
$row = $rs->fetchALL();
echo '<table width="400" border="1">';
echo '<tr><td>主選單</td><td>子選單</td><td>網址</td></tr>';
foreach($row as $key=>$value){
    echo '<tr>';
	echo '<td>'.$value['Main_name'].'</td>';
	echo '<td>'.$value['Sub_name'].'</td>';
	echo '<td>'.$value['url'].'</td>';
	echo '</tr>';
}
echo '</table>';
 
/* //讀取txt檔案的機制
$dir = scandir("./txt/");
$i = count($dir);
for ($j=0 ; $j<=$i ; $j++){
    if (preg_match("/^[A-Z_\-a-z0-9]+$/u", $dir[$j])) {
        echo "{$dir[$j]}專區:<P>";
        $file = fopen("txt/{$dir[$j]}", "r");
        while(! feof($file)) {
            $str = fgets($file);
            if (!empty($str)) {
                $str = explode("|",$str);
                echo "選單項目:{$str[0]}&nbsp&nbsp&nbsp網址:{$str[1]}<br>";
            }
        }
    }
    echo "<p><p>";
}
*/
?>