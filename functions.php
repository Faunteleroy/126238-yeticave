<?php

function renderTemplate($templ_path, $templ_array) {
    if (file_exists($templ_path)) {
        extract($templ_array);
        ob_start ();
        require_once($templ_path);
        $templ_html = ob_get_clean();
        return $templ_html;
    }
    else {
        $templ_html = '';
        return $templ_html;
    }
}

?>