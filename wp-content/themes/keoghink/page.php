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
                                                   <?php $sub_header=get_field('sub_header');?>
                                                    <?php echo $sub_header;?>
                                            <?php endwhile; ?>
                                        </h2>
					<div class="text-box">
						<div class="text-box-holder vscrollable">
							<div class="holder">
                                                            
                                                             <?php if(get_the_ID()==15)
                                                             { ?>                                                               
                                                             <script>   
                                                             $(".text-box-holder").removeClass("vscrollable").css({"overflow" : "hidden"});
                                                             $(".galleryview h2").css({"background" : "none"});
                                                             </script>   
                                                             <?php
                                                             } ?>
                                                            
                                                              <?php if(get_the_ID()==13)
                                                                {
                                                                
                                                                        $old_post = $post;
                                                                        $args = array(
                                                                        'category' => 5,
                                                                        'numberposts' => 4,
                                                                        'order' => 'DESC' 
                                                                        );
                                                                        
                                                                        $testimonials = get_posts($args);
                                                                        if ($testimonials)
                                                                        {
                                                                            foreach ($testimonials as $post)
                                                                            {
                                                                                setup_postdata($post);
                                                                                $name = get_field('name');
                                                                                $job_type = get_field('job_type');
                                                                                $company = get_field('company');
                                                                                $testimonial_text = get_field('testimonial_text');
                                                                  ?>
                                                                                <blockquote class="testimonial">
                                                                                  <?php echo $testimonial_text;?>
                                                                                    <h3 class="testimonial_name">
                                                                                        <?php echo $name."/";?><?php echo $company;?></h3>
                                                                                    <span style="font-size: 13px;">Project Type&nbsp;:<?php echo " ".$job_type;?></span>
                                                                                    
                                                                                </blockquote>
                                                                                <div class="arrow-down"></div>
                                                                  <?php
                                                                                
                                                                                
                                                                            }
                                                                        }
                                                                        $post = $old_post;
                                                                }
                                                                ?>           
                                                            
								<?php while ( have_posts() ) : the_post(); ?>
									<?php
										$url_link = get_field('linkedin_url');
										$url_image = get_field('photo');
										if ($post->post_parent == 7) {
											echo "<a href='$url_link' class='ico-linkedin' target='_blank'>";
											echo get_field('linkedin_url');
											echo "</a>";
											echo "<img src='$url_image' alt='photo' class='imageField' />";
											the_content();
										}
										else {
											the_content();
										}                                                                            
                                                                                ?>
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
						<script type="text/javascript">
							var d = new Date();
							var year = d.getFullYear();
						</script>
						<span>&copy; <span><script type="text/javascript">document.write(year)</script></span> KEOGH INK</span>
					</article>
				</section>
				<section class="sidebar">
					<article class="contact">
						<img src="<?php echo get_template_directory_uri(); ?>/images/text-peace.gif" alt="EXPERTISE + INTERGRITY + CREATIVITY = PEACE OF MIND. Call Us!" />
						<span class="tel">720.272.9057</span>
					</article>
					<article class="title"><h1>
                                                <?php while ( have_posts() ) : the_post(); ?>
                                                     <?php the_title();?>
                                                                       
                                                <?php endwhile; ?>
                                            </h1></article>
					<article class="info">
						<a href="#" class="logo-sidebar">eam creative</a>
						<span>Company Branding and Design by EAM Creative Inc<br /><a href="#">www.eamcreative.com</a></span>
					</article>
				</section>
			</section>

<?php get_footer(); ?>