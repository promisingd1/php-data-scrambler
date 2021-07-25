<?php
	function displayKey($key) {
		printf("value= %s", $key);
	}

	function scrambleData($originalData, $key) {
		$originalKey = "abcdefghijklmnopqrstuvwxyz1234567890$#&*_";
		$data = '';
		$length = strlen($originalData);
		for ($i=0; $i<$length; $i++) {
			$currentchar = $originalData[$i];
			$position = strpos($originalKey, $currentchar);
			if ( $position !== false ) {
				$data .= $key[$position];
			} else {
				$data .= $currentchar;
			}
		}
		return $data;
	}

	function decodeData($originalData, $key) {
		$originalKey = "abcdefghijklmnopqrstuvwxyz1234567890$#&*_";
		$data = '';
		$length = strlen($originalData);
		for ($i=0; $i<$length; $i++) {
			$currentchar = $originalData[$i];
			$position = strpos($key, $currentchar);
			if ( $position !== false ) {
				$data .= $originalKey[$position];
			} else {
				$data .= $currentchar;
			}
		}
		return $data;
	}