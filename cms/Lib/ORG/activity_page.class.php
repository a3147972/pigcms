<?php
class Page{
	// 起始行数
    public $firstRow;
	//现在页数
	public $nowPage;
	//总页数
	public $totalPage;
	//总行数
	public $totalRows;
	//分页的条数
	public $page_rows;
	//分页的参数
	public $page_val;
	//架构函数
	public function __construct($totalRows,$listRows,$page_val){
		$this->totalRows = $totalRows;
		
		/*解析出当前页码*/
		$url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?");
        $parse = parse_url($url);
        if(isset($parse['query'])){
            parse_str($parse['query'],$params);
            if(!empty($params[$page_val])){
				$this->nowPage = $params[$page_val];
			}else{
				$this->nowPage = 1;
			}
        }else{
			$this->nowPage = 1;
		}
		
		// $this->nowPage  = !empty($_GET[$page_val]) ? intval($_GET[$page_val]) : 1;
		$this->listRows = $listRows;
		$this->page_val = $page_val;
		$this->totalPage = ceil($totalRows/$listRows);
		if($this->nowPage > $this->totalPage && $this->totalPage>0){
			$this->nowPage = $this->totalPage;
		}
		$this->firstRow = $listRows*($this->nowPage-1);
	}
    public function show(){
		if($this->totalRows == 0) return false;
		$now = $this->nowPage;
		$total = $this->totalPage;
		$page_val = $this->page_val;
		$url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?");
        $parse = parse_url($url);
        if(isset($parse['query'])){
            parse_str($parse['query'],$params);
            unset($params[$page_val]);
			if(!empty($params)){
				$url  = $parse['path'].'?'.http_build_query($params).'&'.$page_val.'=';
			}else{
				$url = $parse['path'].'?'.$page_val.'=';
			}
        }else{
			$url .= ''.$page_val.'=';
		}
		$str.= '<div class="paginator-wrapper">';
		$str.= '<ul class="paginator paginator--notri paginator--large">';
		if($now > 2){
			$str .= '<li class="previous"><a href="'.$url.'1">首页</a></li>';
		}
		if($now > 1){
			$str .= '<li class="previous"><a href="'.$url.($now-1).'"><i class="tri"></i>上一页</a></li>';
		}
		for($i=1;$i<=5;$i++){
			if($now <= 1){
				$page = $i;
			}elseif($now > $total-1){
				$page = $total-5+$i;
			}else{
				$page = $now-3+$i;
			}
			if($page != $now  && $page>0){
				if($page<=$total){
					$str .= '<li><a href="'.$url.$page.'" title="第'.$page.'页">'.$page.'</a></li>';
				}else{
					break;
				}
			}else{
				if($page == $now) $str .= '<li class="current"><a>'.$page.'</a></li>';
			}
		}
		if ($now != $total){
			$str .= '<li class="next"><a href="'.$url.($now+1).'"><i class="tri"></i>下一页</a></li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
		
		return $str;
    }
}
?>