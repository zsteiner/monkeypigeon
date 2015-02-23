<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
$attributes = shortcode_atts(array(
	'text' => '',
	'url' => '',
	'target' => '',
	'type' => '',
    'text_color' => '',
    'type_hover_color' => '',
    'text_hover_color' => '',
	'outlined' => false,
	'size' => '',
	'icon' => '',
	'align' => 'left',
), $atts);
//$a_class = '';
//
//if ( $el_class != '' ) {
//    $tmp_class = explode(" ", strtolower($el_class));
//    $tmp_class = str_replace(".", "", $tmp_class);
//    if ( in_array("prettyphoto", $tmp_class) ) {
//        wp_enqueue_script( 'prettyphoto' );
//        wp_enqueue_style( 'prettyphoto' );
//        $a_class .= ' prettyphoto';
//        $el_class = str_ireplace("prettyphoto", "", $el_class);
//    }
//    if ( in_array("pull-right", $tmp_class) && $href != '' ) { $a_class .= ' pull-right'; $el_class = str_ireplace("pull-right", "", $el_class); }
//    if ( in_array("pull-left", $tmp_class) && $href != '' ) { $a_class .= ' pull-left'; $el_class = str_ireplace("pull-left", "", $el_class); }
//}
//
//if ( $target == 'same' || $target == '_self' ) { $target = ''; }
//$target = ( $target != '' ) ? ' target="'.$target.'"' : '';
//
//$color = ( $color != '' ) ? ' wpb_'.$color : '';
//$size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' wpb_'.$size : ' '.$size;
//$icon = ( $icon != '' && $icon != 'none' ) ? ' '.$icon : '';
//$i_icon = ( $icon != '' ) ? ' <i class="icon"> </i>' : '';
//$position = ( $position != '' ) ? ' '.$position.'-button-position' : '';
$el_class = $this->getExtraClass($el_class);

//$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button '.$color.$size.$icon.$el_class.$position, $this->settings['base']);
//
//if ( $href != '' ) {
//    $output .= '<span class="'.$css_class.'">'.$title.$i_icon.'</span>';
//    $output = '<a class="wpb_button_a'.$a_class.'" title="'.$title.'" href="'.$href.'"'.$target.'>' . $output . '</a>';
//} else {
//    $output .= '<button class="'.$css_class.'">'.$title.$i_icon.'</button>';
//
//}

$icon_part = '';
if ($attributes['icon'] != '') {
	$icon_part = '<i class="fa fa-'.$attributes['icon'].'"></i>';
}
$btn_id = uniqid('btn-');
$class = array();
$class []= ($attributes['type'] != '')? 'background-color:'.$attributes["type"] : null;
$class []= ($attributes['text_color'] != '') ? 'color:'.$attributes["text_color"] : null;

$style_btn = (!empty($class)) ? 'style="'.implode(';', $class) : '';
$output = '<span class="wpb_button align_'.$attributes['align'].'" id="'.$btn_id.'"><a '. $style_btn .'" href="'.$attributes['url'].'"';
$output .= ($attributes['target'] == '_blank')?' target="_blank"':'';
$output .= 'class="g-btn';
$output .= ($attributes['type'] == '')?' type_default':'';
$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
$output .= ($attributes['outlined'] == 1 OR $attributes['outlined'] == 'yes')?' outlined':'';
$output .= ($el_class != '')?' '.$el_class:'';
$output .= '"><span>'.$icon_part.$attributes['text'].'</span></a></span>';

$hover_actions = array();
if($attributes['text_hover_color'] != '') {
    $hover_actions []= 'color: '.$attributes['text_hover_color'].' !important';
}

if($attributes['type_hover_color'] != '') {
    $hover_actions []= 'background-color: '.$attributes['type_hover_color'].' !important';
}

$outlined = array();
if(($attributes['outlined'] == 1 OR $attributes['outlined'] == 'yes')) {
    $outlined []= 'background-color: rgba(0, 0, 0, 0) !important';
    
    if($attributes['type'] != '')
        $outlined []= 'box-shadow: 0 0 0 2px '.$attributes['type'].' inset';
}

if(!empty($outlined) || !empty($hover_actions)) {
    $output .= '<script type="text/javascript">
                $(document).ready(function () {';
    if(!empty($outlined))
        $output .= '$("head").append("<style>.no-touch #'.$btn_id.' .g-btn.outlined { '.implode(';', $outlined).' } </style>");';

    if(!empty($hover_actions)) {
        $output .= '$("head").append("<style>.no-touch #'.$btn_id.' .g-btn:hover { '.implode(';', $hover_actions).' } </style>");';
    }

    $output .= '});</script>';
}

echo $output . $this->endBlockComment('button') . "\n";