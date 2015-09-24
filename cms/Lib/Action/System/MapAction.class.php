<?php
class MapAction extends BaseAction
{
	public function frame_map()
	{
		$long_lat = $_GET['long_lat'];

		if (!$long_lat) {
			$long_lat = '116.331398,39.897445';
		}

		$this->assign('long_lat', $long_lat);
		$this->display();
	}
}

?>
