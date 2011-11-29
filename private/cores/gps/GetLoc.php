<?php
final class CZCgpsGetLoc extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function exec() {
		$carrier = $this->_cz->newCore('mobile', 'get_carrier_name')->exec();

		switch($carrier) {
			case 'docomo': 
				$lat = $_GET['lat'];
				$lon = $_GET['lon'];
				$geo = $_GET['geo'];
				break;

			case 'softbank': 
				$pos = $_GET['pos'];
				preg_match('/([N|S])(.+)([W|E])(.+)/', $pos, $match);
				$lat = $match[2];
				if($match[1]=='S') $lat = '-' . $lat;
				$lon = $match[4];
				if($match[3]=='W') $lon = '-' . $lon;
				$geo = $_GET['geo'];
				break;

			case 'au': 
				$lat = $_GET['lat'];
				$lon = $_GET['lon'];
/*
				if ($datum = 0) {
					$geo = 'wgs84';
				} elseif ($datum = 1) {
					$geo = 'tokyo';
				}
*/
				$geo = 'wgs84';
				break;

			case 'willcom': 
				$pos = $_GET['pos'];
				preg_match('/([N|S])(.+)([W|E])(.+)/', $pos, $match);
				$lat = $match[2];
				if($match[1]=='S') $lat = '-' . $lat;
				$lon = $match[4];
				if($match[3]=='W') $lon = '-' . $lon;
				$geo = 'tokyo';
				break;

			default: 
				return FALSE;

		}

		return array(
			'lat' => $lat,
			'lon' => $lon,
			'geo' => $geo,
		);

	}
}
?>