<?php
if ( ! empty( $this->content ) ) {
?>
<div id="<?= $this->id ?>">
	<a href="#_list">Retour aux prestations proposées &uarr;</a>
	<h<?= $this->level + 1 ?>><?= $this->get_prefix( ) . $this->title ?></h<?= $this->level + 1 ?>>
	<?= $this->content ?>
	<br>
</div>
<?php
}
?>