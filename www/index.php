<html>
<head>
	<title>Hello world!</title>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<style>
	body {
		background-color: white;
		text-align: center;
		padding: 50px;
		font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
	}

	#logo {
		margin-bottom: 40px;
	}
	</style>
</head>
<body>
	<img id="logo" src="logo.png" />
	<h1><?= 'Hello, '.(($name = getenv('NAME')) !== false ? $name : 'World').'!'; ?></h1>
	<?= ($host = getenv('HOSTNAME')) !== false ? '<h3>My hostname is '.$host.'</h3>' : ''; ?>
	<?php
	
    $links = [];
    foreach($_ENV as $key => $value) {
        if(preg_match('/^(.*)_PORT_([0-9]*)_(TCP|UDP)$/', $key, $matches)) {
    	   $links[] = [
		'name' => $matches[1],
                'port' => $matches[2],
		'proto' => $matches[3],
	    	'value' => $value
	   ];
	}
    }

    if(0 !== count($links)) : ?>
	<h3>Links found</h3>
	<?php foreach($links as $link) : ?>
	    <b><?= $link["name"]; ?></b> listening in <?= $link["port"]+"/"+$link["proto"]; ?> available at <?= $link["value"]; ?><br />
    	<?php endforeach; ?>
    <?php endif; ?>
    <?= (false !== getenv('DOCKERCLOUD_AUTH')) ? '<h3>I have Docker Cloud API powers!</h3>' : ''; ?>
</body>
</html>
