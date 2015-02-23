<?php
$output = $el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'section' => '',
    'full_width' => '',
    'full_height' => '',
    'background' => '',
    'img' => '',
    'bg_fade' => '',
    'parallax' => '',
    'parallax_bg_width' => '',
    'parallax_speed' => '',
    'parallax_reverse' => '',
    'class' => '',
    'section_id' => '',
    'section_textcolor'=>'',
	'section_background'=>'', 
    'row_title' => ''
), $atts));

//wp_enqueue_style( 'js_composer_front' );
//wp_enqueue_script( 'wpb_composer_front_js' );
//wp_enqueue_style('js_composer_custom_css');

//$el_class = $this->getExtraClass($el_class);
$row_title = $atts['row_title'];
$menu_name = $row_title;$id = clean($row_title);$array = array($id);
$additional_class = ($class != '' AND $section != 'yes')?' '.$class:'';

$txtcolor = ( isset($atts['section_textcolor']) && $atts['section_textcolor'] != '')? 'color:'.$atts["section_textcolor"].';':'';
$bgcolor = ( isset($atts['section_textcolor']) && $atts['section_textcolor']  != '')? 'background-color:'.$atts["section_background"].';':'';
$style = ( isset($atts['section_textcolor']) && $atts['section_textcolor']  != '')? 'style="'.$bgcolor.$txtcolor.' " ':'';

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'g-cols'.$el_class, $this->settings['base']);

if ($section == 'yes') {
    $bg_params = '';
    if ($bg_fade != '') {
        $bg_params = ' bg_fade="'.$bg_fade.'"';
    }
	$parallax_params = '';
	if ($parallax != '' and $img != '') {
		$parallax_speeds = array (
			'slow' => 0.2,
			'normal' => 0.4,
			'fast' => 0.6,
			'still' => 0,
		);
		$parallax_speed = (isset($parallax_speeds[$parallax_speed]))?$parallax_speeds[$parallax_speed]:0.4;
		if ($parallax_reverse == 'yes') {
			$parallax_speed = -$parallax_speed;
		}
		$parallax_params = ' parallax="'.$parallax.'" parallax_speed="'.$parallax_speed.'" parallax_bg_width="'.$parallax_bg_width.'"';
	}
	$full_width_params = '';
	if ($full_width == 'yes') {
		$full_width_params .= ' full_width="1"';
	}
	if ($full_height == 'yes') {
		$full_width_params .= ' full_height="1"';
	}
    $section_class_param = ($class != '')?' class="'.$class.'"':'';
    $section_id_param = ($section_id != '')?' id="'.$section_id.'"':'';
	$output .= '[section background="'.$background.'" img="'.$img.'"'.$bg_params.$full_width_params.$parallax_params.$section_class_param.$section_id_param.']';
}

$output .= '<div '.$style.' id="'.$id.'" data-title="'.$menu_name.'" class="vc-rows '.$css_class.$additional_class.'" >';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');

if ($section == 'yes') {
	$output .= '[/section]';
}
echo $output;