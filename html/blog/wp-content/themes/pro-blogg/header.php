<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<header id="head">
		<div class="head-top">		
			<div class="container">
				<div class="head-nav">
					<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
				</div>
				<div class="head-search">
					<?php get_search_form(); ?>
				</div>
				<div class="head-socials">
					<ul>
						<?php
							$socials = array('twitter','facebook','google-plus','instagram','pinterest','vimeo','youtube','linkedin');
							for($i=0;$i<count($socials);$i++){
								$url = '';
								$s = $socials[$i];
								$url = dess_setting('dess_'.$s);
								echo ($url != '' ? '<li><a target="_blank" href="'.$url.'"><img src="'.esc_url( get_stylesheet_directory_uri() ).'/images/'.$s.'-icon.png" alt="'.$s.'" /></a></li>':'');
							}
						?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="head-logo">
			<div class="container">
				<div class="logo">
					<?php echo (dess_setting('dess_logo') != '' ? '<a href="'.home_url().'"><img src="'.dess_setting('dess_logo').'" class="logo" alt="logo" /></a>': '<a href="'.home_url().'"><img src="'.esc_url( get_stylesheet_directory_uri() ).'/images/logo.png" class="logo" alt="logo" /></a>'); ?>	
					<?php //echo '<a href="'.home_url().'"><img src="'.get_header_image().'" class="logo" alt="logo" /></a>'; ?>	
				</div>
			</div>
		</div>
	</header>