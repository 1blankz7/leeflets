<!doctype html>
<html lang="en" data-lf-edit="test-fields">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <!-- Site Meta -->
        <title><?php $this->setting( 'site-meta', 'title' ); ?></title>
        <meta name="description" content="<?php $this->setting( 'site-meta', 'description' ); ?>">
        <meta name="author" content="<?php $this->setting( 'site-meta', 'author' ); ?>">

        <!-- For Mobile Browsers -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Current Template Icons -->
        <link rel="shortcut icon" href="<?php $this->template_url( 'images/favicon.png' ); ?>">

        <?php $this->hook->apply( 'head' ); ?>
    </head>

    <?php
    $bg = '';
    if ( $image = $this->get_content( 'test-fields', 'background-image' ) ) {
        $bg = ' style="background-image: url(' . $this->get_uploads_url( $image ) . ')"';
    }
    ?>

    <body <?php echo $bg; ?>>
        <?php $this->part( 'body' ); ?>

        <?php $this->part( 'footer' ); ?>

        <?php $this->setting( 'analytics', 'code' ); ?>

        <?php $this->hook->apply( 'footer' ); ?>
    </body>
</html>
