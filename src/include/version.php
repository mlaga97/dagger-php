<?php
	$release = exec("git describe --tags | sed 's|release_||; s|-.*||'");
	$branch = exec("git rev-parse --abbrev-ref HEAD");
	$commit = exec("git rev-parse --short HEAD");

	$_SESSION['revisionDate'] = exec("date -d @`git log -n1 --pretty=%at HEAD` -I");
	$_SESSION['versionString'] = "v" . $release . "-" . $branch . "." . $commit;
?>
