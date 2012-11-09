<?php
if ( ! empty( $this->content ) ) {
?>
<div class="document" id="<?= $this->id ?>">
	<h2><?= $this->title; ?></h2>
	<?= $this->content; ?>
	<br>
	<a href="#_list">Retour aux préstations proposées &uarr;</a>
</div>
<?php
}
?>