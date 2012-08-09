<?php get_header(); ?>
<section id="main">
    <section class="content">
        <div class="text-box">
            <div class="text-box-holder" style="overflow: hidden; height: 438px">
                <div class="holder">
                    <div class="git-wrapper">
                        <ul class="gallery-images-table">
                        <?php
                            global $nggRewrite;
                            $ngg_options = nggGallery::get_option('ngg_options');
                            $ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
                            $ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
                            $picturelist = nggdb::get_gallery(1, $ngg_options['galSort'], $ngg_options['galSortDir']);

                            foreach ($picturelist as $im) {
                        ?>
                                    <li>
                                        <div class="image-div">
                                            <img src="<?php echo $im->imageURL; ?>" alt="<?php echo $im->alttext; ?>">
                                        </div>
                                        <div class="image-description">
                                            <?php echo $im->alttext; ?>
                                        </div>
                                    </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <?php
                $args = array();
                $items = wp_get_nav_menu_items('Footer Menu', $args);
            ?> 
            <ul>
                <?php
                    foreach($items as $val) {
                ?>
                <li><a href="<?php echo $val->url ?>"><?php echo $val->title ?></a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
        <article class="copyright">
            <span>&copy; <span><?php echo date('Y'); ?></span> KEOGH INK</span>
        </article>
    </section>
    <section class="sidebar">
        <article class="title">
            <h1>
                <?php
                    while (have_posts()) {
                        the_post();
                        the_title();
                    }
                ?>
            </h1>
        </article>
        <table class="sidebar-text"><tbody><tr><td>
            OUR GALLERY shows the wide variety of creative services we offer ...more filler text here .......
        </td></tr></tbody></table>
        <div class="vscrollable" style="height: 262px; overflow: hidden">
            <ul class="ngg-thumbs">
            <?php
                foreach ($picturelist as $im) {
            ?>
                <li>
                    <a href="#" title="<?php echo $im->title?>">
                        <img src="<?php echo $im->thumbURL?>" alt="<?php echo $im->title?>">
                    </a>
                </li>
            <?php
                }
            ?>
            </ul>
        </div>
        <article class="info">
            <a href="#" class="logo-sidebar">eam creative</a>
            <span>Company Branding and Design by EAM Creative Inc<br /><a href="#">www.eamcreative.com</a></span>
        </article>
    </section>
</section>
<?php get_footer(); ?>