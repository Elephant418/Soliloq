<div class="document cover" id="<?= $this->id ?>">
	<div class="header">
		<div class="from">
			<?= $this->content_from ?>
		</div>
		<div class="to">
			<?= $this->content_to ?>
		</div>
	</div>
	<?= $this->content ?>
</div>
<?= $this->get_subdocuments_to_html( ) ?>