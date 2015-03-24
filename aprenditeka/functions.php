<?php

/*****************************************/

/******          STYLES      *************/

/*****************************************/

function aprenditek_enqueue_styles() {

    // Loads parent stylesheet
	wp_enqueue_style( 'zerif_parent_style', get_template_directory_uri() . '/style.css', array('zerif_pixeden_style'), '1.0' );

}
add_action( 'wp_enqueue_scripts', 'aprenditek_enqueue_styles' );

// Custom Function to Include
function favicon_link() {

    echo '<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png" />' . "\n";
    echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon/favicon.ico" />' . "\n";
    echo '<link rel="manifest" href="/favicon/manifest.json" />' . "\n";
    echo '<meta name="msapplication-TileColor" content="#ffffff" />' . "\n";
    echo '<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png" />' . "\n";
    echo '<meta name="theme-color" content="#ffffff" />' . "\n";
	echo '<meta name="msapplication-config" content="/favicon/browserconfig.xml" />' . "\n";

}
add_action( 'wp_head', 'favicon_link' );


/*****************************************/

/******          WIDGETS     *************/

/*****************************************/

function aprenditek_register_widgets() {

    register_widget('aprenditek_map_widget');

}
add_action('widgets_init', 'aprenditek_register_widgets');


/****************************/

/******    map widget      **/

/****************************/


function aprenditek_map_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('aprenditek_map_widget_script', get_stylesheet_directory_uri() . '/js/widget-map.js', false, '1.0', true);

}
add_action('customize_controls_print_scripts', 'aprenditek_map_widget_scripts');


class aprenditek_map_widget extends WP_Widget
{


    function aprenditek_map_widget()
    {

        $widget_ops = array('classname' => 'aprenditek');

        $this->WP_Widget('aprenditek_map-widget', 'Aprenditek - Map widget', $widget_ops);

    }


    function widget($args, $instance)
    {

        extract($args);


        echo $before_widget;

        ?>


        <div class="col-lg-3 col-sm-3 map-box" data-scrollreveal="enter left after 0s over 1s">


            <div class="map-col">

				<?php if( !empty($instance['image_uri']) ): ?>
				
					<figure class="map-pic">


						<img src="<?php echo esc_url($instance['image_uri']); ?>" alt="">


					</figure>
				
				<?php endif; ?>


                <div class="map-details">

					<?php if( !empty($instance['name']) ): ?>
					
						<h5 class="dark-text red-border-bottom"><?php echo apply_filters('widget_title', $instance['name']); ?></h5>
						
					<?php endif; ?>	

					<?php if( !empty($instance['position']) ): ?>
					
						<div class="position"><?php echo $instance['position']; ?></div>
				
					<?php endif; ?>

					<?php if( !empty($instance['description']) ): ?>
						<div class="details">

							<?php echo $instance['description']; ?>

						</div>
					<?php endif; ?>

                </div>


            </div>


        </div>


        <?php

        echo $after_widget;


    }


    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['name'] = strip_tags($new_instance['name']);

        $instance['position'] = $new_instance['position'];

        $instance['description'] = $new_instance['description'];

        $instance['image_uri'] = strip_tags($new_instance['image_uri']);

        return $instance;

    }


    function form($instance)
    {

        ?>


        <p>

            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name', 'aprenditek'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('name'); ?>"
                   id="<?php echo $this->get_field_id('name'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>"
                   class="widefat"/>

        </p>


        <p>

            <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position', 'aprenditek'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('position'); ?>"
                   id="<?php echo $this->get_field_id('position'); ?>" value="<?php if( !empty($instance['position']) ): echo apply_filters('widget_title', $instance['position']); endif; ?>"
                   class="widefat"/>

        </p>


        <p>

            <label
                for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'aprenditek'); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('description'); ?>"
                   id="<?php echo $this->get_field_id('description'); ?>"
                   value="<?php if( !empty($instance['description']) ): echo apply_filters('widget_title', $instance['description']); endif; ?>" class="widefat"/>

        </p>

		
        <p>

            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image', 'aprenditek'); ?></label><br/>


            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . esc_url($instance['image_uri']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

            ?>


            <input type="text" class="widefat custom_media_url_team"
                   name="<?php echo $this->get_field_name('image_uri'); ?>"
                   id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>"
                   style="margin-top:5px;">


            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_clients"
                   name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image','aprenditek'); ?>"
                   style="margin-top:5px;"/>

        </p>


    <?php

    }

}
