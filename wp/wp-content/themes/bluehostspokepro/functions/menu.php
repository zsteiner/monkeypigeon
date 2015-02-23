<?php

class Walker_Nav_Menu_us extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$level = ( $depth + 2); // because it counts the first submenu as 0
		$classes = array(
			'w-nav-list',
			'level_'.$level,
		);
//		if ($level == 1)
//		{
//			$classes[] = 'layout_hor';
//			$classes[] = 'width_stretch';
//		}
//		elseif ($level == 2)
//		{
//			$classes[] = 'place_down';
//			$classes[] = 'show_onhover';
//		}
//		elseif ($level == 3)
//		{
//			$classes[] = 'place_aside';
//			$classes[] = 'show_onhover';
//		}
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</ul>\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		if( ! empty( $children_elements[$element->$id_field] ) )
			array_push($element->classes,'has_sublevel');

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$level = ( $depth + 1); // because it counts the first submenu as 0

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'w-nav-item';
		$classes[] = 'level_'.$level;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a class="w-nav-anchor level_'.$level.'" '. $attributes .'>';
		$item_output .= $args->link_before.'<span class="w-nav-title">'. apply_filters( 'the_title', $item->title, $item->ID ) .'</span><span class="w-nav-arrow"></span>'. $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</li>\n";
	}

}

class Custom_Walker_Page extends Walker_Page { 

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$level = ( $depth + 2); // because it counts the first submenu as 0
		$classes = array(
			'w-nav-list',
			'level_'.$level,
		); 
		$class_names = implode( ' ', $classes );
 
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</ul>\n";
	}
 
/*
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		if ( !$element )
			return;
			echo '<pre>';
			print_r($element); 
			echo '</pre>';
			die();
			
		if(  $element->post_parent != 0 )
			$current_class = 'has_level';
		
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}  	 
 */ 

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</li>\n";
	}

    function start_el(&$output, $page, $depth, $args, $current_page) {
 
        extract($args, EXTR_SKIP);
 
        $css_class = array();
        $extra = '';
 
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) ) || ( $page->ID == $current_page ) || ( $_current_page && $page->ID == $_current_page->post_parent ) )
                $css_class[] = 'current-menu-item current_page_item'; 
        }		
 
        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));
		$level = $depth + 1;
		$has_level = '';
		if(  $page->post_parent != 0 ){
			$has_level = ' has_sublevel';
		}
        $output .= '<li class=" '. $css_class . 'w-nav-item level_'. $level . $has_level . ' " ><a href="'. get_permalink( $page->ID ) .'" class="w-nav-anchor" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title ) ) ) . '"><span class="w-nav-title">' . apply_filters( 'the_title', $page->post_title ) . '</span></a>';
        $output .= $extra;
 
    }
	
}



class Custom_Responsive_Walker_Page extends Walker_Page { 

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$level = ( $depth + 2); // because it counts the first submenu as 0
		$classes = array(
			'responsive-menu-item',
			'level_'.$level,
		); 
		$class_names = implode( ' ', $classes );
 
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</ul>\n";
	}
  

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</li>\n";
	}

    function start_el(&$output, $page, $depth, $args, $current_page) {
 
        extract($args, EXTR_SKIP);
 
        $css_class = array();
        $extra = '';
 
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) ) || ( $page->ID == $current_page ) || ( $_current_page && $page->ID == $_current_page->post_parent ) )
                $css_class[] = 'current-menu-item current_page_item'; 
        }		
 
        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));
		$level = $depth + 1;
		$has_level = '';
		if(  $page->post_parent != 0 ){
			$has_level = ' has_sublevel';
		}
        $output .= '<li class=" '. $css_class . 'w-nav-item level_'. $level . $has_level . ' " ><a href="'. get_permalink( $page->ID ) .'" class="w-nav-anchor" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title ) ) ) . '"><span class="w-nav-title">' . apply_filters( 'the_title', $page->post_title ) . '</span></a>';
        $output .= $extra;
 
    }
	
}



 
class ResponsivePageSelectWalker extends Walker_Page { 

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$level = ( $depth + 2); // because it counts the first submenu as 0
		$classes = array(
			'w-nav-list',
			'level_'.$level,
		); 
		$class_names = implode( ' ', $classes );
 
		$output .= "\n" . $indent . ' ' . "\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= " ";
	}
  

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$output .= "$indent</option>\n";
	}

    function start_el(&$output, $page, $depth, $args, $current_page) {
 
        extract($args, EXTR_SKIP);
 
        $css_class = array();
        $extra = '';
 
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) ) || ( $page->ID == $current_page ) || ( $_current_page && $page->ID == $_current_page->post_parent ) )
                $css_class[] = 'current-menu-item current_page_item'; 
        }		
 
        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));
		$level = $depth + 1; 
		$dash = '';
		for($k = 1 ; $k<=$level; $k++){
			$dash .= '- ';
		}
        $output .= '<option value="'. get_permalink( $page->ID ) .'" >' . $dash . ' ' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title ) ) ) . ' ';
        
    }
	
}
 

// Add Top Menu
function register_us_menu(){
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu', 'us'),
			/* s'footer-menu' => __('Footer Menu', 'us'), */
		)
	);
}
add_action('init', 'register_us_menu');