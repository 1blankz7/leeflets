<?php 

/*-----------------------------------------------------------------------------------*/
/* Probably not a good idea to modify this file as things are bound to go horribly
/* wrong. Just leave everything as is, and all will be good.
/*-----------------------------------------------------------------------------------*/

include('functions.php');

?>
<!doctype html>

<!--
**********************************************************************************************

Powered by Leeflets v<?php get_leeflets_version(); ?>

You Can Get Your Own Copy on http://leeflets.com

Copyright <?php echo date("Y"); ?> Circa75 Media, LLC

**********************************************************************************************
-->

<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        
        <!-- Site Meta -->
        <title><?php get_site_info('title'); ?></title>
        <meta name="description" content="<?php get_site_info('description'); ?>">
        <meta name="author" content="<?php get_site_info('author'); ?>">
        
        <!-- For Mobile Browsers -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Default Framework Styles -->
        <link rel="stylesheet" href="style.css">
        
        <!-- Current Leeflet Styles -->
        <link rel="stylesheet" href="leeflets/<?php get_site_info('leeflet'); ?>/style.css">
        
        <!-- Current Leeflet Icons -->
        <link rel="shortcut icon" href="leeflets/<?php get_site_info('leeflet'); ?>/images/favicon.png">
        
        <?php get_leeflet_part('header'); ?>
    </head>
    
    <body>
		<?php get_leeflet_part('index'); ?>
		
		<?php get_leeflet_part('footer'); ?>
		
		<?php get_site_info('analytics'); ?>
	</body> 
</html>