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
        $total = 0;
        foreach( $this->parent->subdocuments_service as $document ) {
            include( __DIR__ . '/include/service_table_line.php' );
        }
        include( __DIR__ . '/include/service_table_total.php' );
        ?>
    </table>

    <?php
    if ( count( $this->parent->subdocuments_option ) ) {
        ?>
        <table>
            <tr>
                <th>Options</th>
                <th>Jours</th>
                <th>Tarifs</th>
            </tr>
            <?php
            $option = 0;
            foreach( $this->parent->subdocuments_option as $document ) {
                include( __DIR__ . '/include/service_table_line.php' );
            }
            ?>
        </table>
    <?php
    }
    ?>
    TVA non applicable, art. 293 B du CGI
</div>