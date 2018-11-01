<?php
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
		echo '資料庫连接失败：' . $e->getMessage();
}

function show_table(){
	global $pdo;
    $rs = $pdo->query("SELECT * FROM menu_table");
    $row = $rs->fetchALL();
	return $row;
}

function html_table($row){
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
}
if ($_POST['action'] == 'add'){
    if (preg_match("/^[A-Z_\-a-z0-9]+$/u", $_POST["myname"])) {

	    //DB機制
        $sth = "INSERT INTO `menu_table` SET 
		    `Main_name` = '{$_POST['myname']}',
		    `Sub_name` = '{$_POST['menu']}',
		    `url` = '{$_POST['url_name']}'";
	     $count = $pdo->exec($sth);
	     //echo $count;
	     header('location:fwrite.php?check=add_OK');

	}
    
} elseif ($_GET['check'] == 'add_OK'){
    echo '新增成功'; 
	$row = show_table();
    html_table($row);
} else {
	#echo "{$_POST["myname"]}包含不允許字元，加入失敗";
}
/*
if ($_POST['action'] == 'del'){
	$row = show_table();
	foreach($row as $key => $value){
		if (!is_null($value['Main_name'])){
		    $Main_list[] = $value['Main_name'];
			$Main_name = $value['Main_name'];
		    $Menu_table[$Main_name][] = array(
			    "Sub_name" => $value['Sub_name'], 
			    "url" => $value['url']
		    );
		}	
	}
    $Main_list = array_unique($Main_list);
	foreach($Menu_table as $key => $value){
		echo '<li class="main">';
        echo '  <a class="browse__menu-link" href="#">'.$key.' 選單</a>';
        echo '  <ul class="child">';
		foreach($value as $nu => $Name){
			echo '<li>';
            echo '<a class="browse__menu-link" href="'.$Name['url'].'" style="text-decoration: none" target="targetText">'.$Name['Sub_name'].'</a';
            echo '</li>';
		}
		echo '</ul></li>';
	}
}
*/
?>