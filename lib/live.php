<?php

add_action("wp_enqueue_scripts", function () {
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
		wp_enqueue_script('live.js', 'http://livejs.com/live.js?all');
	}
});
