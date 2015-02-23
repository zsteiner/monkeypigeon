<?php
/*
 * laurels Breadcrumbs
*/
function laurels_custom_breadcrumbs() {

  $laurels_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $laurels_delimiter = '/'; // laurels_delimiter between crumbs
  $laurels_home = __('Home','laurels'); // text for the 'Home' link
  $laurels_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $laurels_before = ' '; // tag before the current crumb
  $laurels_after = ' '; // tag after the current crumb

  global $post;
  $laurels_homelink = esc_url(home_url());

  if (is_home() || is_front_page()) {

    if ($laurels_showonhome == 1) echo '<div id="crumbs" class="laurels-breadcrumb"><a href="' . esc_url($laurels_homelink) . '">' . $laurels_home . '</a></div>';

  } else {

    echo '<div id="crumbs" class="laurels-breadcrumb"><a href="' . esc_url($laurels_homelink) . '">' . $laurels_home . '</a> ' . $laurels_delimiter . ' ';

    if ( is_category() ) {
      $laurels_thisCat = get_category(get_query_var('cat'), false);
      if ($laurels_thisCat->parent != 0) echo get_category_parents($laurels_thisCat->parent, TRUE, ' ' . $laurels_delimiter . ' ');
      echo $laurels_before . _e('Archive by category','laurels') .'"'. single_cat_title('', false) . '"' . $laurels_after;

    } elseif ( is_search() ) {
      echo $laurels_before . _e('Search results for','laurels').' "' . get_search_query() . '"' . $laurels_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $laurels_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $laurels_delimiter . ' ';
      echo $laurels_before . get_the_time('d') . $laurels_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $laurels_delimiter . ' ';
      echo $laurels_before . get_the_time('F') . $laurels_after;

    } elseif ( is_year() ) {
      echo $laurels_before . get_the_time('Y') . $laurels_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $laurels_post_type = get_post_type_object(get_post_type());
        $laurels_slug = $laurels_post_type->rewrite;
        echo '<a href="' . $laurels_homelink . '/' . $laurels_slug['slug'] . '/">' . $laurels_post_type->labels->singular_name . '</a>';
        if ($laurels_showcurrent == 1) echo ' ' . $laurels_delimiter . ' ' . $laurels_before . get_the_title() . $laurels_after;
      } else {
        $laurels_cat = get_the_category(); $laurels_cat = $laurels_cat[0];
        $laurels_cats = get_category_parents($laurels_cat, TRUE, ' ' . $laurels_delimiter . ' ');
        if ($laurels_showcurrent == 0) $laurels_cats = preg_replace("#^(.+)\s$laurels_delimiter\s$#", "$1", $laurels_cats);
        echo $laurels_cats;
        if ($laurels_showcurrent == 1) echo $laurels_before . get_the_title() . $laurels_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $laurels_post_type = get_post_type_object(get_post_type());
      echo $laurels_before . $laurels_post_type->labels->singular_name . $laurels_after;

    } elseif ( is_attachment() ) {
      $laurels_parent = get_post($post->post_parent);
      $laurels_cat = get_the_category($laurels_parent->ID); $laurels_cat = $laurels_cat[0];
      echo get_category_parents($laurels_cat, TRUE, ' ' . $laurels_delimiter . ' ');
      echo '<a href="' . esc_url(get_permalink($laurels_parent)) . '">' . $laurels_parent->post_title . '</a>';
      if ($laurels_showcurrent == 1) echo ' ' . $laurels_delimiter . ' ' . $laurels_before . get_the_title() . $laurels_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($laurels_showcurrent == 1) echo $laurels_before . get_the_title() . $laurels_after;

    } elseif ( is_page() && $post->post_parent ) {
      $laurels_parent_id  = $post->post_parent;
      $laurels_breadcrumbs = array();
      while ($laurels_parent_id) {
        $laurels_page = get_page($laurels_parent_id);
        $laurels_breadcrumbs[] = '<a href="' . esc_url(get_permalink($laurels_page->ID)) . '">' . get_the_title($laurels_page->ID) . '</a>';
        $laurels_parent_id  = $laurels_page->post_parent;
      }
      $laurels_breadcrumbs = array_reverse($laurels_breadcrumbs);
      for ($i = 0; $i < count($laurels_breadcrumbs); $i++) {
        echo $laurels_breadcrumbs[$i];
        if ($i != count($laurels_breadcrumbs)-1) echo ' ' . $laurels_delimiter . ' ';
      }
      if ($laurels_showcurrent == 1) echo ' ' . $laurels_delimiter . ' ' . $laurels_before . get_the_title() . $laurels_after;

    } elseif ( is_tag() ) {
      echo $laurels_before . _e('Posts tagged','laurels') .' "' . single_tag_title('', false) . '"' . $laurels_after;

    } elseif ( is_author() ) {
       global $author;
      $laurels_userdata = get_userdata($author);
      echo $laurels_before . _e('Articles posted by','laurels') . $laurels_userdata->display_name . $laurels_after;

    } elseif ( is_404() ) {
      echo $laurels_before . _e('Error 404','laurels') . $laurels_after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','laurels') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
} // end laurels_custom_breadcrumbs()
