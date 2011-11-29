<?php
final class CZCgpsLocTokyo extends CZBase
{
	/**
	 * @author Takamichi Yanai
	 */
	public function exec($loc) {
		$lat = $loc['lat'];
		$lon = $loc['lon'];

		if ($loc['geo'] == 'wgs84') {
			$lat = $lat + $lat * 0.00010696 - $lon * 0.000017467 - 0.0046020;
			$lon = $lon + $lat * 0.000046047 + $lon * 0.000083049 - 0.010041;
		}

		return array(
			'lat' => $lat,
			'lon' => $lon,
		);
	}
}
?>