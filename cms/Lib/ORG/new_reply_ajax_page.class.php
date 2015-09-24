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

	//架构函数
	public function __construct($totalRows,$listRows){
		$this->totalRows = $totalRows;
		$this->nowPage  = !empty($_POST['page']) ? intval($_POST['page']) : 1;
		$this->listRows = $listRows;
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
		if($total == 1) return false;
		
		$str = '<div class="up_page"><div class="up_page_img"></div>';
		if($now > 1){
			$str .= '<div class="up_page_txt"><a href="javascript:void(0);" data-index="1">上一页</a></div></div>';
		}else{
			$str .= '<div class="up_page_txt">上一页</div></div>';
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
					$str .= '<dd><a href="javascript:void(0);" data-index="'.$page.'">'.$page.'</a></dd>';
				}else{
					break;
				}
			}else{
				if($page == $now) $str .= '<dd class="cur"><span data-index="'.$page.'">'.$page.'</span></dd>';
			}
		}
		$str .= '<div class="next_page">';
		if ($now != $total){
			$str .= '<div class="next_page_txt"><a href="javascript:void(0);" data-index="'.($now+1).'">下一页</a></div>';
		}else{
			$str .= '<div class="next_page_txt">下一页</div>';
		}
		$str .= '<div class="next_page_img"></div><div style="clear:both"></div></div>';
		
		return $str;
    }
}
?>