<?php
  /**
	PMC - PHP
    Copyright (C) 2012  Sebastián Sanabria Díaz - admin@absulit.net

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
   */

	/**
	* Check last time update, if time is bigger
	* @return boolean if is able to update now
	* @param $json_path string JSON filepath
	* @param  $seconds int Seconds to wait
	*/
	function pmc_update_ready($json_path, $seconds) {
		if (file_exists($json_path)) {
			$decoded = json_decode(file_get_contents($json_path), true);
			$time = $decoded["time"];
			$now = time();
			$seconds_waiting = $now - $time;
			$ready = ($seconds_waiting >= $seconds);
		}else {
			$ready = true;
		}
		return $ready;
	}
	
	/**
	* Store Update Time to check later with pmc_update_ready()
	* @return void
	* @param $json_path string JSON filepath
	*/
	function pmc_store_time($json_path) {
		$handle = fopen($json_path, 'w');
		$date = time();
		$time_json = '{"time":' . $date . '}';
		fwrite($handle, $time_json);
		fclose($handle);
	}
	
	function pmc_update_cache($update_function, $cache_function, $json_path, $seconds) {
		$isReady = pmc_update_ready($json_path, $seconds);
		if ($isReady) {
			call_user_func($update_function);
		}else {
			call_user_func($cache_function);
		}
	}
	
	
?>