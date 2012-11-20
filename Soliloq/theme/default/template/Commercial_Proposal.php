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
<div class="document resume" id="_list">
	<h2>Listes des prestations proposées</h2>
	<table>
		<tr>
			<th>Prestations</th>
			<th>Jours</th>
			<th>Tarifs</th>
		</tr>
		<?php
		$option = 0;
		foreach( $this->subdocuments_service as $document ) {
			include( __DIR__ . '/include/service_table_line.php' );
		}
		?>
	</table>

	<table>
		<tr>
			<th>Options</th>
			<th>Jours</th>
			<th>Tarifs</th>
		</tr>
		<?php
		$option = 0;
		foreach( $this->subdocuments_option as $document ) {
			include( __DIR__ . '/include/service_table_line.php' );
		}
		?>
	</table>
	TVA non applicable, art. 293 B du CGI
</div>
<div class="document">
	<?= $this->get_subdocuments_to_html( ) ?>
</div>