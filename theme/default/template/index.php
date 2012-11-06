<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $this->title ?></title>
  <meta name="viewport" content="initial-scale=1.0"> 
  <meta name="creator" content="<?= $this->author ?>"> 
  <style>
  	<?php include( __DIR__ . '/bootstrap.css' ); ?>
  </style>
</head>
<body>
  <?= $this->to_html( ) ?>
</body>
</html>