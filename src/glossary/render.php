<?php

/**
 * Get_formated_content
 *
 * @param  mixed $content COntent.
 * @return array
 */
function get_formated_content( $content ):array {
	$blocks          = parse_blocks( $content );
	$letters_heading = array();
	$glossary        = array();

	// Iterate through the innerblocks.
	foreach ( $blocks as $block ) {
		// Get all the data-letter in the glossary items.
		preg_match_all( '/data-letter="(.*?)"/', $block['innerHTML'], $letters_heading );

		// Separate in arrays every glossary item content.
		$separate_items = explode( '<hr>', $block['innerHTML'] );
	}

	// Remove empty elements.
	$separate_items = array_filter( array_map( 'trim', $separate_items ) );

	foreach ( $separate_items as $item ) {
		preg_match( '/data-letter="(.*?)"/', $item, $letter_item );
		$glossary[ strtoupper( $letter_item[1] ) ][] = $item;
	}

	sort( $letters_heading[1] );
	ksort( $glossary );

	$data['letter_heading'] = array_unique( $letters_heading[1] );
	$data['glossary']       = $glossary;

	return $data;
}
?>
<div class="wp-block-dsebao-glossary-wrapper">
	<?php
	$block_content = get_formated_content( $content );
	?>
	<div class="wp-block-glossary-nav">
		<ul>
			<?php
			$html   = '';
			$option = '';
			foreach ( range( 'a', 'z' ) as $l ) {
				$l = strtoupper( $l );
				if ( in_array( $l, $block_content['letter_heading'], true ) ) {
					$html   .= '<li><a href="#' . $l . '">' . $l . '</a></li>';
					$option .= "<option value='#$l'>$l</option>";
				} else {
					$html   .= "<li>$l</li>";
					$option .= "<option value='$l' disabled>$l</option>";
				}
			}
			echo wp_kses_post( $html );
			?>
		</ul>

		<div class="wp-block-dsebao-glossary-selector-wrapper">
			<?php echo esc_attr( 'Starts with:' ); ?>
			<select name="" id="wp-block-dsebao-glossary-selector">
				<?php echo $option; ?>
			</select>
		</div>
	</div>

	<?php
	foreach ( $block_content['glossary'] as $i => $glossary_item ) {
		echo wp_kses_post( "<header id='$i'><span>$i</span></header>" );
		foreach ( $glossary_item as $letter ) {
			echo wp_kses_post( $letter );
		}
	}
	?>
</div>
