<?php
function redirect_on_index($c_name)
{
    $c_name = strtolower($c_name);
    $url = strtolower(get_current_url());
    $base_url = strtolower(base_url());
    if ($url == $base_url . $c_name OR $url == $base_url . $c_name . "/") {
        redirect($base_url . $c_name . "/index");
        exit();
    }
    //  return ($base_url.$c_name);
}

/**
 * @return string
 */
function get_current_url()
{
    $url_before = isset($_SERVER['REQUEST_SCHEME']) == "http" ? "http://" : "https//";
    $url = $url_before . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $url;
}