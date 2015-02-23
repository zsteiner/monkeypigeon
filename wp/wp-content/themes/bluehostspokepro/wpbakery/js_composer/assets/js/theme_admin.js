/**
 *
 * WPBakery Theme admin.js
 *
 */
jQuery(document).ready(function($){
    /**
     * Theme options reset defaults button as confirmation  before submit
     */
    $('#nhp-opts-footer > input:last, #nhp-opts-header > input:last').click(function(e){

        if(confirm('Are you sure you want to reset to defaults?')) {
        } else {
            e.preventDefault();
        }
    });

    $('#show-as-black').click(function () {
        if($(this).is(':checked')) {
            $('span[style*="color: #ffffff"]').addClass("whiteAsBlack");
        } else {
            $('span[style*="color: #ffffff"]').removeClass("whiteAsBlack");
        }
    });

    $('.include_to_menu').click( function () {
       if($(this).is(':checked') == false) {
           $('input[name="row_title"]').val('');
       }
    });
});
