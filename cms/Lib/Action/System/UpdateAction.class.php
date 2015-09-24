<?php 
class UpdateAction extends BaseAction{
	public $DBCHARSET='UTF8';
	public function index(){
		$thisdomain=$_SERVER['HTTP_HOST'];
		@$str = 'http://weiwincms.weiwin.cc/domainlist.txt';
		$json = file_get_contents ( $str );
		$sstr='';
		if(strstr($json,$thisdomain)==false){
			$sstr= "<link href='asyncbox/skins/ZCMS/asyncbox.css' type='text/css' rel='stylesheet' />
<script type='text/javascript' src='asyncbox/jQuery.v1.4.2.js'></script>
<script type='text/javascript' src='asyncbox/AsyncBox.v1.4.js'></script>
<script type='text/javascript'>
	$(function(){
			asyncbox.alert('你的源码未经授权，暂时无法使用。','授权提示');
			return false;
	});
</script>";
			echo($sstr);
			die();
		}
		$upgrade_path_base="http://weiwincms.weiwin.cc/upgrade3/";
		$pathlist_str = @file_get_contents($upgrade_path_base);
		$pathlist = $allpathlist = array();
		preg_match_all("/\"(weiwincms_(.*)\.zip)\"/", $pathlist_str, $allpathlist);
		$allpathlist = $allpathlist[1];
		$current=str_replace("weiwincms_","",C('VER'));
		$cf=floatval($current);
		$lf=0;
		foreach($allpathlist as $k=>$v) {
			$vv=str_replace("weiwincms_","",$v);
			$vv=str_replace(".zip","",$vv);
			$vf=floatval($vv);
			if($vf>$cf){
				$update1[]=$vf;
			}
		}
		if($update1){
			sort($update1);
		    $lf=$update1[0];
		}else{
			$lf=$cf;
		}	
		$chanageinfo="";
		$updateinfo="<p class='red'>最新版本为：weiwincms_".$lf."</p>";
		if($lf>$cf){
			$updateinfo=$updateinfo."<span><a href='".U('updating')."'>点击更新</a></span>";
			$chanageinfo=file_get_contents("http://weiwincms.weiwin.cc/upgrade3/upgrade.txt");
		}else{
			$updateinfo=$updateinfo."<span>已经是最新版本，不需要更新</span>";
		}
		
		$this->assign('updateinfo',$updateinfo);
		$this->assign('chanageinfo',$chanageinfo);
		$this->display();
	}
	public function updating(){
		$upgrade_path_base="http://weiwincms.weiwin.cc/upgrade3/";
		$pathlist_str = @file_get_contents($upgrade_path_base);
		$pathlist = $allpathlist = array();
		preg_match_all("/\"(weiwincms_(.*)\.zip)\"/", $pathlist_str, $allpathlist);
		$allpathlist = $allpathlist[1];
		$current=str_replace("weiwincms_","",C('VER'));
		$cf=floatval($current);
		$lf=0;
		foreach($allpathlist as $k=>$v) {
			$vv=str_replace("weiwincms_","",$v);
			$vv=str_replace(".zip","",$vv);
			$vf=floatval($vv);
			if($vf>$cf){
				$update1[]=$vf;
			}
		}
		sort($update1);
		$update[]="weiwincms_".$update1[0].".zip";
		$lf=$update1[0];
		require "Update.class.php";
		
		$this->mkdirs('./updatetemp');
		
		foreach($update as $k=>$v){
			$url=$upgrade_path_base.$v;
			$this->get_file($url,$v,'./updatetemp');
			$upgradezip_source_path='./updatetemp/'.$v;
			$upgradezip_path=str_replace(".zip","",$upgradezip_source_path);
			$this->mkdirs($upgradezip_path);
			$archive = new PclZip($upgradezip_source_path);			
			if($archive->extract(PCLZIP_OPT_PATH, $upgradezip_path, PCLZIP_OPT_REPLACE_NEWER) == 0) {
				die("Error : ".$archive->errorInfo(true));
			}
			$copy_from = $upgradezip_path."/";
			$copy_to = "./";
			$file_list=null;
			$file_list = glob($copy_from .'*.sql');
			if($file_list){
				foreach($file_list as $f=>$l){
					$sqlfile=$l;
					$sql = file_get_contents($sqlfile);
					$sql = str_replace("\r\n", "\n", $sql);
					$sql = str_replace("weiwin",c('DB_NAME'),$sql);
					$sql = str_replace("wy_",C('DB_PREFIX'), $sql);
					$this->runquery($sql);
					unlink($sqlfile);
				}
			}

			$this->copyfailnum = 0;
			$this->copydir($copy_from, $copy_to, 1);
		
			$this->deletedir($upgradezip_path);
			$this->deletedir($upgradezip_source_path);
			
		}
		$this->deletedir('./updatetemp');
		
		$updat=array('VER'=>'weiwincms_'.$lf);
		$file='version.php';
		$this->update_config($updat,CONF_PATH.$file);
		
		$updateinfo="<p class='red'>最新版本为：weiwincms_".$lf."</p><span>已经是最新版本，不需要更新</span>";
		$chanageinfo="更新成功。";
		$this->assign('updateinfo',$updateinfo);
		$this->assign('chanageinfo',$chanageinfo);
		$this->display('index');
	}
	
	function get_file($url,$name,$folder = './')
	{
		set_time_limit((24 * 60) * 60);
		// 设置超时时间
		$destination_folder = $folder . '/';
		// 文件下载保存目录，默认为当前文件目录
		if (!is_dir($destination_folder)) {
			// 判断目录是否存在
			$this->mkdirs($destination_folder);
		}
		$newfname = $destination_folder.$name;
		// 取得文件的名称
		$file = fopen($url, 'rb');
		// 远程下载文件，二进制模式
		if ($file) {
			// 如果下载成功
			$newf = fopen($newfname, 'wb');
			// 远在文件文件
			if ($newf) {
				// 如果文件保存成功
				while (!feof($file)) {
					// 判断附件写入是否完整
					fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
				}
			}
		}
		if ($file) {
			fclose($file);
		}
		if ($newf) {
			fclose($newf);
		}
		return true;
	}
	
	function mkdirs($path, $mode = '0777')
	{
		if (!is_dir($path)) {
			// 判断目录是否存在
			$this->mkdirs(dirname($path), $mode);
			// 循环建立目录
			mkdir($path, $mode);
		}
		return true;
	}
	
	public function copydir($dirfrom, $dirto, $cover='') {
		//如果遇到同名文件无法复制，则直接退出
		if(is_file($dirto)){
			die(L('have_no_pri').$dirto);
		}
		//如果目录不存在，则建立之
		if(!file_exists($dirto)){
			mkdir($dirto);
		}
		 
		$handle = opendir($dirfrom); //打开当前目录
	
		//循环读取文件
		while(false !== ($file = readdir($handle))) {
			if($file != '.' && $file != '..'){ //排除"."和"."
				//生成源文件名
				$filefrom = $dirfrom.DIRECTORY_SEPARATOR.$file;
				//生成目标文件名
				$fileto = $dirto.DIRECTORY_SEPARATOR.$file;
				if(is_dir($filefrom)){ //如果是子目录，则进行递归操作
					$this->copydir($filefrom, $fileto, $cover);
				} else { //如果是文件，则直接用copy函数复制
					if(!empty($cover)) {
						if(!copy($filefrom, $fileto)) {
							$this->copyfailnum++;
							echo L('copy').$filefrom.L('to').$fileto.L('failed')."<br />";
						}
					} else {
						if(fileext($fileto) == 'html' && file_exists($fileto)) {
	
						} else {
							if(!copy($filefrom, $fileto)) {
								$this->copyfailnum++;
								echo L('copy').$filefrom.L('to').$fileto.L('failed')."<br />";
							}
						}
					}
				}
			}
		}
	}
	
	//循环删除目录和文件函数
function deletedir($dirName)
{
    if ($handle = opendir("$dirName")) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
                if (is_dir("$dirName/$item")) {
                    $this->deletedir("$dirName/$item");
                } else {
                    unlink("$dirName/$item");
                }
            }
        }
        closedir($handle);
        rmdir($dirName);
    }
}
	
	function runquery($sql) {
		$haha = M();
	
		if(!isset($sql) || empty($sql)) return;
	
		$ret = array();
		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
	
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				if(substr($query, 0, 12) == 'CREATE TABLE') {
					$line = explode('`',$query);
					$data_name = $line[1];
					//showjsmessage(lang('create_table').' '.$data_name.' ... '.lang('succeed'));
					$haha->execute($this->droptable($data_name));
					/**
					 * 转码
					*/
					if (strtoupper($this->DBCHARSET) == 'GBK'){
						$query = iconv('GBK','UTF-8',$query);
					}
					$haha->execute($this->createtable($query));
					unset($line,$data_name);
				} else {
					$haha->execute($query);
				}
			}
		}
	}
	
	function droptable($table_name){
		return "DROP TABLE IF EXISTS `". $table_name ."`;";
	}
	
	function createtable($sql) {
		preg_match("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*COMMENT=(.*)$/isU", $sql,$match);
		list(,,$type,$comment) = $match;
		$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
		return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
		(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=".$this->DBCHARSET : " TYPE=$type");
	}
	
	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			//$config = require $config_file;
			//$config = array_merge($config, $new_config);
			//dump($config);EXIT;
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}
}
?>
