<?php
function include_template($template_name, $data) {
    $template = 'templates/' . $template_name . '.php';
    if (is_file($template)) {
        ob_start();
        include($template);
        return ob_get_clean();
    } else {
       return '';
    }
}
?>