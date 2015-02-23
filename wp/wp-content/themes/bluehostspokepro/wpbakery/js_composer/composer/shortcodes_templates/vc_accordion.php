<?php
$attributes = shortcode_atts(
	array(
		'toggle' => ''
	), $atts);

global $first_tab, $first_tab_title, $auto_open;


$toggle_class = '';
if ($attributes['toggle'] == 'yes') {
	$toggle_class = ' type_toggle';
} else {
	$auto_open = TRUE;
	$first_tab_title = TRUE;
	$first_tab = TRUE;
}
$output = '<div class="w-tabs layout_accordion with_icon'.$toggle_class.'"><div class="w-tabs-h">'.do_shortcode($content).'</div></div>';

$auto_open = FALSE;
$first_tab_title = FALSE;
$first_tab = FALSE;

echo $output;