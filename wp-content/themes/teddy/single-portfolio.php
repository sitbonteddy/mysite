<?php
get_header();

$thumb_id = get_post_thumbnail_id($page->ID);
$thumb_url = wp_get_attachment_image_src($thumb_id, true);
$image = $thumb_url[0];

$mypost = get_post(get_the_ID());
$content = apply_filters('the_content',$mypost->post_content);


global $post;
$agence  = get_post_meta($post->ID,'teddy_agence',true);
$client  = get_post_meta($post->ID,'teddy_client',true);
$skills  = get_post_meta($post->ID,'teddy_skills',true);
$site    = get_post_meta($post->ID,'teddy_web',true);
?>

<section id="article_img" style="background-image: url('<?php echo $image;?>');">
   <div class="background_article"></div>
   <span class="inner_one">
        <span class="inner_two">
            <span class="inner_three">
                <h1 class="heading_1 title_article">
                    <a href="<?php echo $site;?>" target="_blank" class="effect_p">
                        <span data-letters="<?php echo the_title();?>"><?php the_title();?></span>
                    </a>
                </h1>
            </span>
        </span>
    </span>
    <a href="#intro" class="scroll " title="Learn more about me">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="arrow_svg" x="0px" y="0px" viewBox="0 0 96.6 95.4" enable-background="new 0 0 96.6 95.4" xml:space="preserve" class="svg arrow floating replaced-svg">
            <polygon fill="#FFFFFF" points="45.8,59.9 64.8,44.9 61.5,40.7 45.8,53.1 30.1,40.7 26.8,44.9 45.7,59.9 45.8,60 45.8,60 45.8,60   "></polygon>
        </svg>
    </a>
</section>


<section id="intro">
    <h2 class="heading_2">à propos</h2>
    <div class="contact_p">
        <span class="agency"><span class="c_color">Agence :</span> <?php echo $agence;?></span> - <span class="client"><span class="c_color">Client :</span> <?php echo $client;?></span>
    </div>
    <div class="description">
        <?php echo $content;?>
    </div>
    <ul class="category">
        <?php foreach($skills as $skill){
            echo '<li>'.$skill.'</li>';
        }?>
    </ul>
</section>

<section id="me_project">
    <div class="wid">Ce que j'ai fait</div>
    
    
    
</section>

<section id="next_article">
	<p>Parcourir les différents projets</p>
	<?php
	// Création de liens : un peu chelou 
    $args = array( 'post_type'=>'portfolio', 'showposts'=>'-1');
    $recent_posts = wp_get_recent_posts( $args );
    $this_link = get_permalink();
    $nb_post = count($recent_posts);
    $i = 0;
    foreach( $recent_posts as $recent ){
    	if(get_permalink($recent["ID"]) == $this_link){
    		if($i == 0){
    			$nb_prev = ($nb_post-1);
    			$nb_next = 1;
    		}else if($i == ($nb_post-1)){
    			$nb_prev = $i -1;
    			$nb_next = 0;
    		}else{
    			$nb_prev = $i - 1;
    			$nb_next = $i +1;
    		}
    	}
    	$i++;
    }
    $prev = get_permalink($recent_posts[$nb_prev]["ID"]);
    $next = get_permalink($recent_posts[$nb_next]["ID"]);
    ?>
    <a href="<?php echo $prev; ?>" class="prev link">Précédent</a>
	<a href="<?php echo $next; ?>" class="next link">Suivant</a>
</section>


<?php
get_footer();
?>