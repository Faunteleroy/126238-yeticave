<?php

function renderTemplate($templ_path, $templ_array) {
    if (file_exists($templ_path)) {
        extract($templ_array);

        ob_start ();
        require_once($templ_path);
        $templ_html = ob_get_clean();

    } else {
        $templ_html = '';
    }
    return $templ_html;
}

define("SECONDS_IN_MIN", 60);
define("SECONDS_IN_HOUR", 3600);
define("SECONDS_IN_DAY", 86400);

function bets_time($time_label) {
    $now = strtotime('now');

    $count_time = $now - $time_label;

    if ($count_time > SECONDS_IN_DAY) {
        $bet_time = date("d.m.y \в H:i", $time_label);
    }
    else if ($count_time >= SECONDS_IN_HOUR) {
        $count_hour = floor(($now - $time_label) / SECONDS_IN_HOUR);
        $bet_time = $count_hour . " часов назад";
    }
    else {
        $count_min = floor((($now - $time_label) % SECONDS_IN_HOUR) / SECONDS_IN_MIN);
        $bet_time = $count_min . " минут назад";
    }

    return $bet_time;
}

