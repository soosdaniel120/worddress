<?php

	// v0.1

	$filename = basename( __FILE__ ); // worddress.php
	$htaccess = __DIR__ . DIRECTORY_SEPARATOR . '.htaccess';
	$config = __DIR__ . DIRECTORY_SEPARATOR . 'wp-config.php';

	if( isset( $_POST[ 'wd_install' ] ) ) {

		$new_htaccess = __DIR__ . DIRECTORY_SEPARATOR . '.htaccess-wp-' . time();

		rename( $htaccess, $new_htaccess );

		file_put_contents( $htaccess, 'DirectoryIndex worddress.php index.php' );

		// header( 'location: .' );

	} else {}

	$installed = FALSE;

	if( ! file_exists( $htaccess ) ) {

		die( 'error1' );

	} else {}

	if( ! is_writable( $htaccess ) ) {

		die( 'error2' ); // chmod

	} else {}

	$htaccess_c = file_get_contents( $htaccess );

	$pos = strpos( $htaccess_c, $filename );

	if( $pos !== FALSE ) {

		$installed = TRUE;

	} else {}

	if( ! $installed ) {

?>
<!DOCTYPE html>
<html lang="en">

		<head>

			<title>WordDress Install</title>
			<meta charset="utf8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		</head>

		<body>

			<form method="post"><input type="submit" name="wd_install" value="WordDress Install" /></form>

		</body>

</html>
<?php

		exit;

	} else {}

	if( ! file_exists( $config ) ) {

		die( 'error3' );

	} else {}

	$config_c = file_get_contents( $config );

	preg_match_all( '/define\(.\'(?<name>.*?)\'\,.\'(?<value>.*?)\'.\)\;/', $config_c, $matches );

	foreach( $matches[ 'name' ] as $key=> $name ) {

		define( $name, $matches[ 'value' ][ $key ] );

		// DB_NAME
		// DB_USER
		// DB_PASSWORD
		// DB_HOST
		// DB_CHARSET
		// DB_COLLATE

	}

	preg_match( '/\$table_prefix.=.\'(?<table_prefix>.*?)\'\;/', $config_c, $match );

	$table_prefix = $match[ 'table_prefix' ];

	// global $wp
	// global $wp_query

	// template
	// stylesheet

	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

	$mysqli-> set_charset( DB_CHARSET );

	// DB_COLLATE

?>
