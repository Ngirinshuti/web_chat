<?php 
	
	date_default_timezone_set("Africa/Kigali");

	class Dates
	{
		protected $now;

		function __construct()
		{
			$this->now = strtotime(date("Y-m-d H:i:s"));
		}

		function dateDiff($date1, $date2) {
			$dateDiff = strtotime($date1) - strtotime($date2);
			return ($dateDiff/60);
 		}

		function dateDiffStr($date){
			$diff = $this->now - strtotime($date);
			if ($diff < 60) {
				if ($diff >= 0) {
					return "now"; //($diff == 1 || $diff == 0)? "1 sec" : $diff . "s";
				}else{
					if ($diff > -60) {
						return " next " . $diff . "s";
					}
					elseif ($diff <= -60 && $diff > -3600) {
						return " next " . round($diff/-60) . "m";
					}
					elseif ($diff <= -3600 && $diff > -86400) {
						// $hours = date_format(date_create($date), "H:i");
						return " next " . round($diff/-3600) . "hr";
					}
					elseif ($diff <= -86400 && $diff > (-86400 * 7)) {
						if (round($diff/-86400) == 1) {
							return "Tommorow " . date("G:i", strtotime($date));
							exit;
						}
						return date("D, M j", strtotime($date));
					}
					else {
						$year = date_format(date_create($date), "Y");

						if ($year == date("Y", $this->now)) {
							return date("M j", strtotime($date));
						}else{
							return date("M j, Y", strtotime($date));
						}
					}
				}
			}
			elseif ($diff >= 60 && $diff < 3600) {
				return round($diff/60) . "m";
			}
			elseif ($diff >= 3600 && $diff < 86400) {
				// $hours = date_format(date_create($date), "H:i");
				return (round($diff/3600) > 1 )? round($diff/3600) . "h" : "1h";
			}
			elseif ($diff >= 86400 && $diff < (86400 * 7)) {
				if (round($diff/86400) == 1) {
					return "Yesterday " . date("G:i", strtotime($date));
					exit;
				}
				return  date("D, G:i", strtotime($date));
			}
			else {
				$year = date_format(date_create($date), "Y");

				if ($year == date("Y", $this->now)) {
					return  date("M j", strtotime($date));
				}else{
					return date("M j, Y", strtotime($date));
				}
			}
		}
	}