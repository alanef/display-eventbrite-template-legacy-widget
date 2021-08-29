<?php
/**
 * Front end display of widget loop
 * can be overridden in child themes / themes or in wp-content/widget-for-eventbrite-api folder if you don't have a child theme and you don't want to lose changes due to themes updates
 *
 * To customise create a folder in your theme directory called widget-for-eventbrite-api and a modified version of this file called widget.php
 *
 * @var mixed $data Custom data for the template.
 */
// Recent posts wrapper
printf( '<div %1$s class="eaw-legacy eaw-block %2$s">',
	( ! empty( $data->args['cssID'] ) ? 'id="' . esc_attr( $data->args['cssID'] ) . '"' : '' ),
	( ! empty( $data->args['css_class'] ) ? '' . esc_attr( $data->args['css_class'] ) . '' : '' )
);

if ( false !== $data->events && $data->events->have_posts() ) {
	?>
    <ul class="eaw-ulx">

		<?php while ( $data->events->have_posts() ) {
			$data->events->the_post();

			$booknow = esc_url( eventbrite_event_eb_url( ( $data->args['tickets'] ) ? '#tickets' : '' ) );
			?>

            <li class="eaw-li eaw-clearfix">

			<?php if ( $data->args['thumb'] ) {
				?>
                <span>
                 <?php
                 // Check if post has post thumbnail.
                 if ( ! empty( $data->events->post->logo_url ) ) {
	                 // Thumbnails
	                 printf( '<a class="eaw-img" href="%1$s" rel="bookmark" %6$s><img class="%2$s eaw-thumb eaw-default-thumb" src="%3$s" alt="%4$s" width="%5$s"></a>',
		                 $booknow,
		                 esc_attr( $data->args['thumb_align'] ),
		                 esc_url( $data->events->post->logo_url ),
		                 esc_attr( get_the_title() ),
		                 (int) $data->args['thumb_width'],
		                 ( $data->args['newtab'] ) ? 'target="_blank"' : ''
	                 );

	                 // Display default image.
                 } elseif ( ! empty( $data->args['thumb_default'] ) ) {
	                 printf( '<a class="eaw-img" href="%1$s" rel="bookmark" %6$s><img class="%2$s eaw-thumb eaw-default-thumb" src="%3$s" alt="%4$s" width="%5$s"></a>',
		                 $booknow,
		                 esc_attr( $data->args['thumb_align'] ),
		                 esc_url( $data->args['thumb_default'] ),
		                 esc_attr( get_the_title() ),
		                 (int) $data->args['thumb_width'],
		                 ( $data->args['newtab'] ) ? 'target="_blank"' : ''
	                 );
                 }
                 ?>
                 </span>
				<?php

			} ?>

            <h3 class="eaw-title">
				<?php
				printf( '<a href="%1$s" title="%2$s" rel="bookmark" %4$s>%3$s</a>',
					$booknow,
					sprintf( esc_attr__( 'Eventbrite link to %1$s', 'widget-for-eventbrite-api' ), the_title_attribute( 'echo=0' ) ),
					the_title_attribute( 'echo=0' ),
					( $data->args['newtab'] ) ? 'target="_blank"' : ''
				);
				?>
            </h3>

			<?php if ( $data->args['date'] ) {
				$date = wfea_event_time();
				printf( '<time class="eaw-time published" datetime="%1$s">%2$s</time>', esc_html( get_the_modified_date( 'c' ) ), esc_html( $date ) );
			}

			if ( $data->args['excerpt'] ) {
				?>
                <div class="eaw-summary">
					<?php
					echo wp_trim_words( apply_filters( 'eawp_excerpt', get_the_excerpt() ), $data->args['length'], ' &hellip;' );
					if ( $data->args['readmore'] ) {
						printf( '<a href="%1$s" %3$s aria-label="%2$s %5$ %4$s" class="more-link">%2$s</a>',
							esc_url( eventbrite_event_eb_url() ),
							wp_kses_post($data->args['readmore_text']),
							( $data->args['newtab'] ) ? 'target="_blank"' : '',
							esc_attr( get_the_title() ),
							esc_html__( 'on Eventbrite about', 'widget-for-eventbrite-api' )
						);
					}
					?>
                </div>
				<?php
			}

			if ( $data->args['booknow'] ) {
				?>
                <div class="eaw-booknow"> <?php
				switch ( $data->template ) {
					case 'divi':
						$button_markup = '<a href="%1$s" class="submit et_pb_button" %3$s  aria-label="%2$s %5$ %4$s">%2$s</a>';
						break;
					default:
						$button_markup = '<a href="%1$s" class="button" %3$s  aria-label="%2$s %5$ %4$s">%2$s</a>';
				}
				printf( $button_markup,
					$booknow,
					wp_kses_post($data->args['booknow_text']),
					( $data->args['newtab'] ) ? 'target="_blank"' : '',
					esc_attr( get_the_title() ),
					__( 'on Eventbrite for', 'widget-for-eventbrite-api' )
				);
				?></div><?php
			}

			?></li><?php

		}

		?></ul>

	<?php

} else {
	?>
    <p class='not-found'><?php esc_html_e( 'No Events Found', 'widget-for-eventbrite-api' ); ?></p>
	<?php
}
?>
</div><!-- Generated by https://wordpress.org/plugins/widget-for-eventbrite-api/ -->


