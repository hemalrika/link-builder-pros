<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ayaa
 */

get_header();
$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 8;
$sidebar_class = is_active_sidebar( 'blog-sidebar' ) ? 'theme-has-blog-sidebar' : 'theme-has-blog-no-sidebar';
$cbblog_layout = get_theme_mod('cbblog_layout') ? get_theme_mod('cbblog_layout') : 'right-sidebar';
if(isset($_GET['s'])) {
	$search = $_GET['s'];
}
$sidebar_space = '';
if($cbblog_layout == 'right-sidebar') {
	$sidebar_space = is_active_sidebar( 'blog-sidebar' ) ? 'ml-50' : '';
} else if($cbblog_layout == 'left-sidebar') {
	$sidebar_space = is_active_sidebar( 'blog-sidebar' ) ? 'mr-50' : '';
} else {
	$blog_column = 8;
}
?>

	<main id="primary" class="blog-page pt-100 pb-60 <?php echo esc_attr($sidebar_class); ?>">
		<div class="container">
			<div class="row justify-content-center">
				<?php if($cbblog_layout == 'left-sidebar') : ?>
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="ayaa-details-sidebar">
								<?php dynamic_sidebar('blog-sidebar');?>
							</div>
						</div>
					<?php endif;?>
				<?php endif; ?>
				<div class="col-lg-<?php print esc_attr( $blog_column );?> col-md-12 col-sm-12">
					<div class="blog-wrapper">
						<?php
							if ( have_posts() ):
							if ( is_home() && !is_front_page() ):
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
						</header>
						<?php endif;?>
						<?php
							/* Start the Loop */
							while ( have_posts() ): the_post(); ?>
							<h1>hiiiiii</h1>
							<?php
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								if(is_single()) {
									get_template_part( 'post-formates/single-post/content', get_post_format() );
								} else {
									get_template_part( 'post-formates/content', get_post_format() );
								}
							endwhile;
							?>
								<?php ayaa_pagination( '<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>', '', ['class' => ''] );?>
							<?php
							else:
								get_template_part( 'post-formates/content', 'none' );
							endif;
						?>
					</div>
				</div>
				<?php if($cbblog_layout == 'right-sidebar') : ?>
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="ayaa-details-sidebar <?php echo is_active_sidebar( 'blog-sidebar' ) ? esc_attr($sidebar_space) : ''; ?>">
								<?php dynamic_sidebar('blog-sidebar');?>
							</div>
						</div>
					<?php endif;?>
				<?php endif; ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
