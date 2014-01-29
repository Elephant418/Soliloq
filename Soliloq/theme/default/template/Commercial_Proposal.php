<div class="document cover" id="<?= $this->id ?>">
	<div class="header">
		<div class="from">
			<?= $this->content_from ?>
		</div>
		<div class="to">
			<?= $this->content_to ?>
		</div>
	</div>
	<h<?= $this->level ?>><?= $this->title ?></h<?= $this->level ?>>
	<?= $this->content ?>
</div>
<div class="document">
	<?= $this->get_subdocuments_to_html( ) ?>
</div>