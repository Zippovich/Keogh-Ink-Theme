<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
            <section id="main">
				<section class="content">
					<h2><?php while ( have_posts() ) : the_post(); ?>
                                                                      <?php echo (get_post_meta($post->ID, 'label', true));?>
                                                                       
                                                                <?php endwhile; ?>
                                        </h2>
					<div class="text-box">
						<div class="text-box-holder vscrollable">
							<div class="holder">
								<?php while ( have_posts() ) : the_post(); ?>
                                                                      <?php the_content();?>

                                                                <?php endwhile; ?>
							</div>
						</div>
					</div>
					<nav>
                                                <?php $args = array()?> 
                                                <?php $menu_name = 'twentyeleven';?>
                                                <?php $items = wp_get_nav_menu_items('Footer Menu', $args); ?> 
						<ul>
							    <?php foreach($items as $val) { ?>
                                                            <li><a href="<?php echo $val->url ?>"><?php echo $val->title ?></a></li>
                                                        
                                                        <?} ?>
						</ul>
					</nav>
					<article class="copyright">
						<span>&copy; 2010 KEOGH INK</span>
					</article>
				</section>
				<section class="sidebar">
					<article class="contact">
						<img src="<?php echo get_template_directory_uri(); ?>/images/text-peace.gif" alt="EXPERTISE + INTERGRITY + CREATIVITY = PEACE OF MIND. Call Us!" />
						<span class="tel">720.272.9057</span>
					</article>
					<article class="title"><h1>home</h1></article>
					<article class="info">
						<a href="#" class="logo-sidebar">eam creative</a>
						<span>Company Branding and Design by EAM Creative Inc<br /><a href="#">www.eamcreative.com</a></span>
					</article>
				</section>
			</section>

<?php get_footer(); ?>