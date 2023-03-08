<?php
$letter = ! empty( $attributes['letter'] ) ? $attributes['letter'] : '';
?>

<div id="glossary-item-<?php echo esc_attr( wp_unique_id() ); ?>" class="wp-block-glossary-item" data-letter="<?php echo esc_attr( $letter ); ?>">
	<?php echo wp_kses_post( $content ); ?>
</div>
