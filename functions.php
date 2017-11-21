<?php
function include_template($template_name, $data) {
    $template = 'templates/' . $template_name . '.php';
    if (file_exists($template)) {
        ob_start();
        include($template);
        return ob_get_clean();
    } else {
       return '';
    }
}
?>