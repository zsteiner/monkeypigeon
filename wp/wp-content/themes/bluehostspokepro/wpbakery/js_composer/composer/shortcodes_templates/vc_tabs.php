<?php
$attributes = shortcode_atts(
	array(
		'timeline' => '',
	), $atts);

global $first_tab, $first_tab_title, $auto_open, $is_timeline;
$auto_open = TRUE;
$first_tab_title = TRUE;
$first_tab = TRUE;



if ($attributes['timeline'] == 'yes') {
	$is_timeline = TRUE;

	$content_titles = str_replace('[vc_tab', '[timepoint_title', $content);
	$content_titles = str_replace('[/vc_tab', '[/timepoint_title', $content_titles);

	$output = '<div class="w-timeline"><div class="w-timeline-h"><div class="w-timeline-list"><div class="w-timeline-list-h">'.do_shortcode($content_titles).'</div></div><div class="w-timeline-sections">'.do_shortcode($content).'</div></div></div>';
} else {
	$is_timeline = FALSE;

	$content_titles = str_replace('[vc_tab', '[item_title', $content);
	$content_titles = str_replace('[/vc_tab', '[/item_title', $content_titles);

	$output = '<div class="w-tabs"><div class="w-tabs-h"><div class="w-tabs-list">'.do_shortcode($content_titles).'</div>'.do_shortcode($content).'</div></div>';
}


$is_timeline = FALSE;
$auto_open = FALSE;
$first_tab_title = FALSE;
$first_tab = FALSE;

echo $output;