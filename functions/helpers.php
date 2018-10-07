<?php

/**
 * Organiza os termos para melhor visualização, separados por vírgula e com 'e' no ultimo item
 * ex.: termo1, termo2 e termo3
 */
function terms_grammar($terms) {
	if (is_wp_error($terms))
		return;

	$count = 0;
	$output = '';

	foreach ($terms as $term) {
		$count++;
		$output .= '<a class="term-' . $term->slug . '" href="' . add_query_arg('terms', $term->term_id, get_home_url()) . '">';

		if ( count( $terms ) > 1 ) {
			if ( ($count + 1) != count( $terms ) and ($count) != count( $terms ) ) {
				$output .= $term->name . '</a>' . '<span>, </span>';
			} elseif ( ($count + 1) == count( $terms ) ) {
				$output .= $term->name . '</a>' . '<span> e </span>';
			} else {
				$output .= $term->name . '</a>';
			}
		} else {
			$output .= $term->name . '</a>';
		}
	}

	return $output;
}

/*
 * Limitar caracteres no echo
 */
function limit_chars($string, $length){
	if (strlen($string) <= $length) { 
		return $string;
	} else {
    	$cropped = substr($string, 0, $length) . '...';
		return $cropped;
	}
}

/*
 * paginação
 */
function pagination($current, $max) {

	if (!$current)
		$current = get_query_var('paged') ? get_query_var('paged') : 1;
	
	if (!$max)
		$max = $wp_query->max_num_pages;
	
	$big = 999999999; // need an unlikely integer
	
	$paginate_links = paginate_links( array(
		'base'     => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'   => '?paged=%#%',
		'current'  => max(1, $current),
		'total'    => $max,
		'prev_text' => '«',
		'next_text' => '»',
		'type'     => 'array',
	));

	if ($paginate_links) {
		echo '<ul class="pagination">';
		
		foreach ($paginate_links as $link) {

			if (strpos($link, '/page/') !== false) {
				$page_number = get_string_between($link, '/page/', '/');
				$attr = ' data-next-page="' . $page_number . '" ';
				$link = substr_replace($link, $attr, strpos($link, 'href'), 0);
			}

			echo $link;
		}

		echo '</ul>';
	}
}