<?php

echo $this->content;
foreach ( $this->subdocuments as $document ) {
	echo $document->to_html( );
}

?>