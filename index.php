<?php
/*
Plugin Name: Call Button
Description: Adds a "Call now" button to the bottom of phone screens.
Version: 1.0
Author: Michael McDonagh
*/

// Add a submenu in the "Settings" menu
add_action('admin_menu', 'call_button_add_submenu');
function call_button_add_submenu() {
    add_submenu_page(
        'options-general.php', // Parent menu slug
        'Call Button Settings', // Page title
        'Call Button', // Menu title
        'manage_options', // Capability required
        'call-button-settings', // Menu slug
        'call_button_settings_page' // Callback function
    );
}

// Callback function for the settings page
function call_button_settings_page() {
    // Save settings if form is submitted
    if (isset($_POST['call_button_submit'])) {
        update_option('call_button_text', sanitize_text_field($_POST['call_button_text']));
        update_option('call_button_number', sanitize_text_field($_POST['call_button_number']));
        update_option('call_button_text_color', sanitize_text_field($_POST['call_button_text_color']));
        update_option('call_button_bg_color', sanitize_text_field($_POST['call_button_bg_color']));
        update_option('call_button_width', sanitize_text_field($_POST['call_button_width']));
        update_option('call_button_height', sanitize_text_field($_POST['call_button_height']));
        update_option('call_button_padding', sanitize_text_field($_POST['call_button_padding']));
        update_option('call_button_margin', sanitize_text_field($_POST['call_button_margin']));
        update_option('call_button_font_size', sanitize_text_field($_POST['call_button_font_size']));
        update_option('call_button_font_size_type', sanitize_text_field($_POST['call_button_font_size_type']));
        update_option('call_button_z_index', sanitize_text_field($_POST['call_button_z_index']));
        update_option('call_button_css', sanitize_textarea_field($_POST['call_button_css']));
   
        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }

    // Retrieve saved settings
    $call_button_text = get_option('call_button_text', 'Call now');
    $call_button_number = get_option('call_button_number', '');
    $call_button_text_color = get_option('call_button_text_color', '#ffffff');
    $call_button_bg_color = get_option('call_button_bg_color', '#000000');
    $call_button_width = get_option('call_button_width', '100');
    $call_button_height = get_option('call_button_height', '50');
    $call_button_padding = get_option('call_button_padding', '10');
    $call_button_margin = get_option('call_button_margin', '10');
    $call_button_font_size = get_option('call_button_font_size', '16');
    $call_button_font_size_type = get_option('call_button_font_size_type', 'px');
    $call_button_z_index = get_option('call_button_z_index', '0'); // Added z-index option
    $call_button_css = get_option('call_button_css', '');

    ?>

    <div class="wrap">
        <h1>Call Button Settings</h1>

        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="call_button_text">Button Text:</label></th>
                    <td><input type="text" id="call_button_text" name="call_button_text" value="<?php echo esc_attr($call_button_text); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_number">Phone Number:</label></th>
                    <td><input type="text" id="call_button_number" name="call_button_number" value="<?php echo esc_attr($call_button_number); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_text_color">Text Color:</label></th>
                    <td><input type="text" id="call_button_text_color" name="call_button_text_color" value="<?php echo esc_attr($call_button_text_color); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_font_size">Font Size:</label></th>
                    <td>
                        <input type="number" id="call_button_font_size" name="call_button_font_size" min="1" max="100" step="1" value="<?php echo esc_attr($call_button_font_size); ?>" />
                        <select id="call_button_font_size_type" name="call_button_font_size_type">
                            <option value="px" <?php selected($call_button_font_size_type, 'px'); ?>>px</option>
                            <option value="em" <?php selected($call_button_font_size_type, 'em'); ?>>em</option>
                            <option value="rem" <?php selected($call_button_font_size_type, 'rem'); ?>>rem</option>
                            <option value="%" <?php selected($call_button_font_size_type, '%'); ?>>%</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_bg_color">Background Color:</label></th>
                    <td><input type="text" id="call_button_bg_color" name="call_button_bg_color" value="<?php echo esc_attr($call_button_bg_color); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_z_index">Z-index:</label></th>
                    <td><input type="number" id="call_button_z_index" name="call_button_z_index" min="0" step="1" value="<?php echo esc_attr($call_button_z_index); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_width">Width:</label></th>
                    <td>
                        <input type="range" id="call_button_width" name="call_button_width" min="0" max="100" step="1" value="<?php echo esc_attr($call_button_width); ?>" />
                        <input type="number" id="call_button_width_number" name="call_button_width" min="0" max="100" step="1" value="<?php echo esc_attr($call_button_width); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_height">Height:</label></th>
                    <td>
                        <input type="range" id="call_button_height" name="call_button_height" min="0" max="200" step="1" value="<?php echo esc_attr($call_button_height); ?>" />
                        <input type="number" id="call_button_height_number" name="call_button_height" min="0" max="200" step="1" value="<?php echo esc_attr($call_button_height); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_padding">Padding:</label></th>
                    <td>
                        <input type="range" id="call_button_padding" name="call_button_padding" min="0" max="50" step="1" value="<?php echo esc_attr($call_button_padding); ?>" />
                        <input type="number" id="call_button_padding_number" name="call_button_padding" min="0" max="50" step="1" value="<?php echo esc_attr($call_button_padding); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_margin">Margin:</label></th>
                    <td>
                        <input type="range" id="call_button_margin" name="call_button_margin" min="0" max="50" step="1" value="<?php echo esc_attr($call_button_margin); ?>" />
                        <input type="number" id="call_button_margin_number" name="call_button_margin" min="0" max="50" step="1" value="<?php echo esc_attr($call_button_margin); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="call_button_css">Custom CSS:</label></th>
                    <td><textarea id="call_button_css" name="call_button_css" rows="5"><?php echo esc_textarea(get_option('call_button_css', '')); ?></textarea></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="call_button_submit" class="button-primary" value="Save Changes" />
            </p>
        </form>
    </div>

    <script>
        // Update range input number fields
        jQuery(document).ready(function($) {
            $('#call_button_width, #call_button_height, #call_button_padding, #call_button_margin').on('input', function() {
                $('#' + this.id + '_number').val($(this).val());
            });
        });
    </script>

    <?php
}

// Enqueue the button script and styles
add_action('wp_enqueue_scripts', 'call_button_enqueue_scripts');
function call_button_enqueue_scripts() {
    wp_enqueue_script('call-button-script', plugin_dir_url(__FILE__) . 'call-button.js', array('jquery'), '1.0', true);
    wp_enqueue_style('call-button-style', plugin_dir_url(__FILE__) . 'call-button.css');
}

// Add the button markup to the footer
add_action('wp_footer', 'call_button_display_button');
function call_button_display_button() {
    $call_button_text = get_option('call_button_text', 'Call now');
    $call_button_number = get_option('call_button_number', '');
    $call_button_text_color = get_option('call_button_text_color', '#ffffff');
    $call_button_bg_color = get_option('call_button_bg_color', '#000000');
    $call_button_width = get_option('call_button_width', '100');
    $call_button_height = get_option('call_button_height', '50');
    $call_button_padding = get_option('call_button_padding', '10');
    $call_button_margin = get_option('call_button_margin', '10');
    $call_button_font_size = get_option('call_button_font_size', '16');
    $call_button_font_size_type = get_option('call_button_font_size_type', 'px');
    $call_button_z_index = get_option('call_button_z_index', '0');
    $call_button_css = get_option('call_button_css', '');

    if (!empty($call_button_number)) {
        ?>
        <style>
            .call-button {
                color: <?php echo esc_attr($call_button_text_color); ?>;
                background-color: <?php echo esc_attr($call_button_bg_color); ?>;
                width: <?php echo esc_attr($call_button_width); ?>%;
                height: <?php echo esc_attr($call_button_height); ?>px;
                padding: <?php echo esc_attr($call_button_padding); ?>px;
                margin: <?php echo esc_attr($call_button_margin); ?>px;
                font-size: <?php echo esc_attr($call_button_font_size); ?><?php echo esc_attr($call_button_font_size_type); ?>;
                z-index: <?php echo esc_attr($call_button_z_index); ?>;
                <?php echo esc_html($call_button_css); ?>
            }
        </style>
        <a href="tel:<?php echo esc_attr($call_button_number); ?>" class="call-button"><?php echo esc_html($call_button_text); ?></a>
        <?php
    }
}
