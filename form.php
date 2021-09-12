<h1>Option Demo Admin Page</h1>
<form method="POST" action="<?php admin_url( 'admin-post.php' )?>">
    <?php
        wp_nonce_field( "optionsdemo" );
        $optiondemo_langitude = get_option('optionsdemo_longitude');
    ?>
    <label for="optionsdemo_longitude"><?php _e( 'Longitude', 'optionsdemo' )?></label>
    <input type="text" id="optionsdemo" name="optionsdemo_longitude" value="<?php echo esc_attr($optiondemo_langitude) ?>">
    <input type="hidden" name="action">

    <?php
        submit_button( 'Save' );
    ?>
</form>
