<?php

if (isset($_GET['ID'])) {
	# redirect as workaround for inset File dialog in the PageBuilder
	# which is broken because ?ID=<$fileID> is mistaken for a Page ID by LeftAndMain
	# lets replace ID with FileID which is then converted back in PageBuilder
	$match = true;
	$url = $_GET['url'];
	foreach(['PageBuilder', 'EditorToolbar', 'viewfile'] as $str) {
		if (strpos($url, $str) === FALSE) {
			$match = false;
			break;
		}
	}
	if ($match) {
		$id = $_GET['ID'];
		$_GET['url'] = str_replace(['?ID=','&ID='],['?FileID=','&FileID='], $url);
		$_REQUEST['FileID'] = $id;
		$_GET['FileID'] = $id;
		unset($_REQUEST['ID']);
		unset($_GET['ID']);
	}
}

# use index.php as entry point to make x-debug folder mapping work out of the box
chdir('framework');
require 'framework/main.php';
