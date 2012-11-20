<tr>
	<td>
	<?php
		echo '<strong>' . $document->get_prefix( ) . $document->title . '</strong><br>';
		echo $document->resume;
		if ( ! empty( $document->content ) ) {
			echo ' <a href="#' . $document->id .'">Plus &rarr;</a>';
		}
	?>
	</td>
	<td><?= $document->quantity . ' ' . $document->unit ?></td>
	<td><?= ( $document->quantity * $document->unit_cost ) . ' ' . $document->currency ?></td>
</tr>