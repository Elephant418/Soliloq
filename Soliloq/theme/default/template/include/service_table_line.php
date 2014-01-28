<?php
    $amount = ( $document->quantity * $document->unit_cost );
    $total += $amount;
?>
<tr>
	<td>
	<?php
		echo '<strong>' . $document->get_prefix( ) . $document->title . '</strong><br>';
		echo $document->resume;
		if ( ! empty( $document->content ) ) {
			echo ' <a href="#' . $document->id .'">En savoir plus &rarr;</a>';
		}
	?>
	</td>
	<td><?= $document->quantity . ' ' . $document->unit ?></td>
	<td><?= $amount . ' ' . $document->currency ?></td>
</tr>