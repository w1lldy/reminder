<?php

function reminder_form_shortcode() {
    ob_start();
    include ABSPATH . 'test_reminder.php';  // Путь к файлу test_reminder.php    
    return ob_get_clean();
}
add_shortcode('reminder_form', 'reminder_form_shortcode');

?>