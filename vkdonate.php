<?php 
/**
 * Plugin Name: Vkontakte Donate
 * Plugin URI: http://plugins.yourwordpresscoder.com/vkdonate/
 * Description: Display VKontakte donate widget on your site
 * Version: 1.0
 * Author: Your Wordpress Coder
 * Author URI: http://plugins.yourwordpresscoder.com/vkcomments/
 */

add_action( 'widgets_init', 'load_vkdonate_featured_widget' );

function load_vkdonate_featured_widget() {
	register_widget( 'VKDonate_widget' );
}

class VKDonate_widget extends WP_Widget {
	
	function VKDonate_widget() {
        
		load_plugin_textdomain ( 'vkdonate' , false, 'vkdonate/languages'  );
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'vkontakte_donate_widget', 'description' => __('Display VKontakte donate widget on your website', 'vkdonate') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'vkontakte-donate-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'vkontakte-donate-widget', __('Vkontakte donate', 'vkdonate'), $widget_ops, $control_ops );
		
		
    }
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );
		
		$title = apply_filters('widget_title', 'VKontakte Donate' );
	
		echo $before_widget;

		if ( $title ):
			echo $before_title . __($instance['vkontakte_donate_widget_title']) . $after_title;
        ?>
        <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?20"></script>

        <div id="<?php echo $instance['vkontakte_donate_widget_containter_id']; ?>"></div>
        <script type="text/javascript">
            VK.Widgets.Donate("<?php echo $instance['vkontakte_donate_widget_containter_id']; ?>", {mode: <?php echo (int)$instance['vkontakte_donate_widget_type']; ?>, width: "<?php echo $instance['vkontakte_donate_widget_width']; ?>"}, <?php echo $instance['vkontakte_donate_api']; ?>);
        </script>

        <?php
        endif;

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

        $instance['vkontakte_donate_widget_title'] = strip_tags( $new_instance['vkontakte_donate_widget_title'] );
		$instance['vkontakte_donate_widget_width'] = (int)( $new_instance['vkontakte_donate_widget_width'] );
		$instance['vkontakte_donate_api'] = (int)$new_instance['vkontakte_donate_api'];
        $instance['vkontakte_donate_widget_containter_id'] = strip_tags( $new_instance['vkontakte_donate_widget_containter_id'] );
        $instance['vkontakte_donate_widget_type'] = (int)$new_instance['vkontakte_donate_widget_type'];

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'vkontakte_donate_widget_type' => 0, 'vkontakte_donate_widget_containter_id' => 'vk_donate','vkontakte_donate_widget_width' => 200,'vkontakte_donate_widget_title' => 'Donate us', 'vkontakte_donate_api' => '', 'vkontakte_donate_widget_width' => '200' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_donate_widget_title' ); ?>"><?php _e('Widget title', 'vkdonate')?>:</label>
			<input style="width: 95%;" id="<?php echo $this->get_field_id( 'vkontakte_donate_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_donate_widget_title' ); ?>" value="<?php echo $instance['vkontakte_donate_widget_title']; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_donate_api' ); ?>"><?php _e('VKontakte API ID', 'vkdonate')?>:</label>
			<input style="width: 95%;" id="<?php echo $this->get_field_id( 'vkontakte_donate_api' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_donate_api' ); ?>" value="<?php echo $instance['vkontakte_donate_api']; ?>" />
		</p>
        
		<p>
            <label for="<?php echo $this->get_field_id( 'vkontakte_donate_widget_type' ); ?>"><?php _e('Widget type mode', 'vkdonate')?>:</label>
            <select style="width: 100%;" id="<?php echo $this->get_field_id( 'vkontakte_donate_widget_type' ); ?>"  name="<?php echo $this->get_field_name( 'vkontakte_donate_widget_type' ); ?>"><option value="0"><?php _e('Compact', 'vkdonate'); ?></option><option <?php echo $checked = $instance['vkontakte_donate_widget_type'] == 1 ? "selected=\"selected\"" : ''; ?> value="1"><?php _e('Advances', 'vkdonate'); ?></option></select>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_donate_widget_containter_id' ); ?>"><?php _e('Container div ID', 'vkdonate')?>:</label>
			<input style="width: 95%;" id="<?php echo $this->get_field_id( 'vkontakte_donate_widget_containter_id' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_donate_widget_containter_id' ); ?>" value="<?php echo $instance['vkontakte_donate_widget_containter_id']; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_donate_widget_width' ); ?>"><?php _e('Width of container', 'vkdonate')?>:</label>
			<input style="width: 95%;" id="<?php echo $this->get_field_id( 'vkontakte_donate_widget_width' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_donate_widget_width' ); ?>" value="<?php echo $instance['vkontakte_donate_widget_width']; ?>" />
		</p>

		
	<?php
	}
	
	
}

