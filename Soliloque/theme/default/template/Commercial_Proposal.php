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
<div class="document resume">
	<h2>Listes des préstations proposées</h2>
	<table>
		<tr>
			<th>Préstation</th>
			<th>Jours</th>
			<th>Tarifs</th>
		</tr>
		<?php
		$option = 0;
		foreach( $this->subdocuments as $document ) {
			if ( $document->doctype == 'Service' ) {
				$prefix = '';
				if ( $document->is_optional ) {
					$option++;
					$prefix = 'Option ' . $option . ' : ';
				}
		?>
			<tr>
				<td>
				<?php
					echo '<strong>' . $prefix . $document->title . '</strong><br>';
					echo $document->resume;
					if ( ! empty( $document->content ) ) {
						echo ' <a href="#' . $document->id .'">Plus de détails ></a>';
					}
				?>
				</td>
				<td><?= $document->quantity . ' ' . $document->unit ?></td>
				<td><?= ( $document->quantity * $document->unit_cost ) . ' ' . $document->currency ?></td>
			</tr>
			<?php
			}
		}
		?>
	</table>
	TVA non applicable, art. 293 B du CGI
</div>
<?= $this->get_subdocuments_to_html( ) ?>