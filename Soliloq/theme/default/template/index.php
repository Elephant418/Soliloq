<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8">
  <title><?= $this->title ?></title>
  <meta name="viewport" content="initial-scale=1.0"> 
  <meta name="creator" content="<?= $this->author ?>"> 
  <style>
  	<?php include( Pixel418\Soliloq\theme_path( 'bootstrap.css' ) ); ?>
  	<?php include( Pixel418\Soliloq\theme_path( 'style.css' ) ); ?>
    <?php include( Pixel418\Soliloq\theme_path( 'override.css' ) ); ?>
	@page {
	    @bottom-left {
	        content: "<?= $this->title ?>";
	    }
	}
  </style>
</head>
<body>
  <?= $this->to_html( ) ?>
</body>
</html>