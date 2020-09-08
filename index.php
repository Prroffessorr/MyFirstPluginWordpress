<?php
/**
 *
 * Plugin Name: MyFirst Plugin
 **/

//plugin install script
// register_activation_hook( __FILE__, 'WpLogoInstallScript' );
// function WpLogoInstallScript() {
//     require_once('install-script.php');
// }

// Translate all text & labels of plugin ###
// add_action('plugins_loaded', 'TranslateWpLoginLogo');
// function TranslateWpLoginLogo() {
//     load_plugin_textdomain('WebritiCustomLoginTD', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
// }

// Admin dashboard Menu Pages For WP Login Logo Plugin
add_action('admin_menu','wp_login_log_menu');
function wp_login_log_menu() {
    // Wp Login Logo Page in Settings menu
   // add_menu_page('menu page', 'Add data', 'manage_options', 'custom-panel', 'custom_panel');
    $SubMenu = add_menu_page( 'menu page', 'Add data', 'manage_options', 'webriti-login', 'webriti_login_page' );
    add_action( 'admin_print_styles-' . $SubMenu, 'logo_css_js' );
}

//load plugin required css and js fiels
function logo_css_js() {
    //js
    // wp_enqueue_script('jquery-ui-core', includes_url('/js/jquery/ui/jquery.ui.core.min.js'), array('jquery') );
    // wp_enqueue_script('dashboard');
    // wp_enqueue_script( 'theme-preview' );
    wp_enqueue_script('media-uploads-js',plugins_url('assets/js/js.js', __FILE__), array('media-upload','thickbox','jquery'));

    //color-picker css n js
    // wp_enqueue_style( 'wp-color-picker' );
    // wp_enqueue_script( 'my-color-picker-script', plugins_url('js/my-color-picker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    // wp_enqueue_style('my-bootstrap', plugins_url('css/wbr_login_bootstrap.css',__FILE__));
    //css
    // wp_enqueue_style('dashboard');
    // wp_enqueue_style('thickbox');
}

//WP Login Logo plugin admin menu page
function webriti_login_page(){ ?>
    <style type="text/css">
        label {
            margin-right: 20px;
        }
        .logo-prv {
            max-height: 67px;
            max-width: 326px;
            padding: 5px;
            margin-top: 10px;
            border: 1px solid #e3e3e3;
            background: #f7f7f7;
            -moz-border-radius: 3px;
            -khtml-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }
		.img-nwsltr {
            max-height:100%;
            max-width: 100%;
            padding: 5px;
            margin-top: 10px;
            border: 7px solid #2ea2cc;
            background: #f7f7f7;
            -moz-border-radius: 3px;
            -khtml-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }
        .upimg {
            /*for help*/
        }

        .wrap {

            padding: 10px 10px 10px 10px;
            border-radius: 4px 4px;
        }
        .welcome-panel {
            padding: 10px 0px 5px 0px;
            margin: 5px 0;
        }
        .theme-snaps {
            width: 380px;
            height: 180px;
            padding: 5px;
            margin-top: 10px;
            border: 1px solid #e3e3e3;
            background: #f7f7f7;
            -moz-border-radius: 3px;
            -khtml-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }
        #dashboard_right_now table td {
            padding: 10px 0;
        }
        #TB_inline {
            text-align: center;
        }
    </style>
    <script>
        // hide n show upload button
        jQuery('#enable-custom-logo').click(function(){
            if (jQuery(this).is(':checked', true)) {
                alert(1);
            } else {
                alert(2);
            }
        });

        //settings save js function
        function savesettings() {
            //var EnableLogo = jQuery('input[type="radio"]:checked').val();
            var LogoUrl = jQuery("#logo-url").val();
           // var CustomBGColor = jQuery("#custom-background-color").val();
            var PostData = "action=save_logo_settings&LogoUrl=" + LogoUrl;
            jQuery.ajax({
                dataType : 'html',
                type: 'POST',
                url : ajaxurl,
                cache: false,
                data : PostData,
                complete : function() {  },
                success: function(data) {
                    alert("<?php _e("Settings successfully saved.", "WebritiCustomLoginTD"); ?>");
                }
            });
        }
        //reset plugin settings
        function resetsettings() {
            var PostData = "action=reset_logo_settings";
            jQuery.ajax({
                dataType : 'html',
                type: 'POST',
                url : ajaxurl,
                cache: false,
                data : PostData,
                complete : function() {  },
                success: function(data) {
                    alert("Settings successfully reset.");
                }
            });
        }
    </script>	
	<style>
	.nav-tab-active, .nav-tab-active:hover {
color: black;
background:#fff;
border-color: #CCC;
border-bottom-color: #F1F1F1;
}
.nav-tab{
background:rgb(47, 150, 180);
color: #fff;
}
.nav-tab-active{
color: black;
background:#fff;
border-color: #CCC;
border-bottom-color: #F1F1F1;
}

	</style>
    <div class="wrap">
	<?php 
 if(isset($_GET['tab'])) 
	$SeletedTab = $_GET['tab'];
 else
	$SeletedTab = 'homepage';
	
 if ($SeletedTab=='homepage') { ?>
        <div id="dashboard-widgets-wrap">

        <div class="metabox-holder columns-2" id="dashboard-widgets">
            <!--left side panel-->
            <div class="postbox-container" id="postbox-container-1" style="width: 70%">
                <div class="meta-box-sortables ui-sortable" id="normal-sortables"><div class="postbox " id="dashboard_right_now">
                    <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span><?php _e("Login Page Customization & Settings", "WebritiCustomLoginTD"); ?></span></h3>
                        <div class="inside" style="padding-right:10px">
                            <?php
                                $Settings = get_option('wp_login_logo_settings');
                                //$EnableLogo = $Settings['enable_logo'];
                                $LogoUrl = $Settings['logo_url'];
                                //$CustomBGColor = $Settings['custom_bg_color'];
                            ?>
                            <?php add_thickbox(); ?>
                            <div id="check-preview" style="display:none; text-align: center;">
                                <iframe src="<?php echo site_url()."/wp-login.php"; ?>" style="width:500px; height:500px; margin-left: 70px; margin-top: 10px;" ></iframe>
                            </div>
                           
                            <table style="margin-left:10px;margin-right:20px">
                                <tbody>
                                    
                                    <tr>
                                        <td><label><?php _e("Upload Custom Logo", "WebritiCustomLoginTD"); ?></label></td>
                                        <td>
                                            
                                            
                                            <img src="<?php echo $LogoUrl; ?>" class="logo-prv" id="logo-img-prv" alt="" style="width:100% height=100" <?php if($LogoUrl == "") echo "style='display:none;'"; ?>>
                                            <div id="img-prev">
                                            <input type="text" id="logo-url" placeholder="No media selected!"  readonly="readonly" value="<?php if($LogoUrl) echo $LogoUrl; ?>" />
                                            <input type="button" id="upload-logo" class="button upimg" value="Upload Logo"/>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <input id="save-logo-settings" name="save-logo-settings" class="button-primary button-large" onclick="return savesettings();" type="button" value="<?php _e("Save Settings", "WebritiCustomLoginTD"); ?>">
                                            <input id="reset-logo-settings" name="reset-logo-settings" class="button-primary button-large" onclick="return resetsettings();" type="button" value="<?php _e("Reset", "WebritiCustomLoginTD"); ?>">
                                        </td>
                                    </tr>
									<tr>
									<td>
									</td>
									<td>
									 <a  href="#TB_inline?width=500&height=510&inlineId=check-preview" class="button button-primary button-hero load-customize   thickbox"><?php _e("Check Preview", "WebritiCustomLoginTD"); ?></a>
									 </td>
									</tr>
                                </tbody>
                            </table>
                            <br class="clear">
                        </div>
                    </div>
                </div>
            </div>
        <div class="clear"></div>
        </div>
    </div>
		<?php
		}
		if ($SeletedTab=='pro') {
		?>
		
		<!-- <?php //require_once('login_pro.php'); ?> -->
		<?php
		}
}


//save plugin settings
add_action("wp_ajax_save_logo_settings", "savelogosettings");
function savelogosettings() {
    if(isset($_POST['action']) == "save_logo_settings") {
        print_r($_POST);
        //$EnableLogo = $_POST['EnableLogo'];
        $LogoUrl = $_POST['LogoUrl'];
        //$CustomBGColor = $_POST['CustomBGColor'];
        $Settings = array(
            //'enable_logo' => $EnableLogo,
            'logo_url' => $LogoUrl,
            //'custom_bg_color' => $CustomBGColor
        );
        update_option('wp_login_logo_settings', $Settings);
    }
}

//reset plugin settings
add_action("wp_ajax_reset_logo_settings", "resetlogosettings");
function resetlogosettings() {
    if(isset($_POST['action']) == "reset_logo_settings") {
        $Settings = array(
            'enable_logo' => "no",
            'logo_url' => "",
            'custom_bg_color' => ""
        );
        update_option('wp_login_logo_settings', $Settings);
    }
}

function smallenvelop_login_message( $message ) {
    if ( empty($message) ){
        return "<p><strong>Welcome to SmallEnvelop. Please login to continue</strong></p>";
    } else {
        return $message;
    }
}

add_filter( 'login_message', 'smallenvelop_login_message' );

//loading logo settings
function applying_wp_custom_login_settings() {
    $Settings = get_option('wp_login_logo_settings');
    //$EnableLogo = $Settings['enable_logo'];
    $LogoUrl = $Settings['logo_url'];
    //$CustomBGColor = $Settings['custom_bg_color'];
    //if($EnableLogo == 'yes') { ?>
        <style type="text/css">
        <?php
        if($CustomBGColor != "") { ?>
            /* body {
                background-color: <?php echo $CustomBGColor; ?> !important;
            } */
        <?php
        }
        if($LogoUrl != "") {
        ?>
            body.login div#login h1 a {
                display:none;
            }
            .tab{
            justify-content: center;
            text-align: center;
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 0px 10px 0;
            display: inline-block;
            border-bottom: 2px solid #1161ee; /* Параметры линии */ 
            }
            .login form {
                background-image: url('<?php echo $LogoUrl; ?>') !important;
                margin: auto;
                display: block;
                max-width:500px;
                max-height:500px;
                box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19) !important;
                padding: 120px 120px 100px 120px !important; 
                position: fixed !important;
                top: 50%; left: 50% !important;
                transform: translate(-50%, -50%);
                
            }
            .login form .submit #wp-submit, #user_pass, #user_login{
            width: 100% !important;
            display: block;
            min-height: 50px;
            border: none;
            padding: 15px 50px;
            border-radius: 25px;
            font-size: 12pt;
            text-align: center;
            }
            .login form .submit #wp-submit{
                background: #1161ee;

            }
            .login form p{
                color: #aaa;
                font-size: 12px;
                margin-top: 10px;
                margin-bottom: 10px;
                text-transform: uppercase;
                text-align:  center !important; 
                margin:20px;
            }
        <?php
        } ?>
            .login #backtoblog a {
                text-shadow: none;
            }
            .login #nav a {
                text-shadow: none;
            }
           
            .login form .forgetmenot label{
                display: none;
            }
            .login #nav a{
                display: none;
            }
            .login #backtoblog a{
                display: none;
            }
            
        </style><?php
   //}

}
add_action( 'login_enqueue_scripts', 'applying_wp_custom_login_settings', 10,0 );


 function gettext_filter($translation, $orig, $domain) {
    
    switch($orig) {
        case 'Username or Email Address':
            $translation = "Username";
            break;
        case 'Username':
            $translation = "Username";
            break;
        case 'Password':
            $translation = 'Password';
            break;
        case 'Log In':
            $translation = 'Увійти';
            break;
        
    }
    return $translation;
}
add_filter('gettext', 'gettext_filter', 10, 3); 

