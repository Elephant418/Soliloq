<?php
if ( ! is_null( $this->content ) ) {
?>
<div class="document" id="<?= $this->id ?>">
	<h<?= $this->level ?>><?= $this->title ?></h<?= $this->level ?>>
	<?= $this->content ?>
	<?= $this->get_subdocuments_to_html( ) ?>
</div>
<?php
}
?>