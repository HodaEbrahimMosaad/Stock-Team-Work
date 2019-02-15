<?php
if(!function_exists('get_session'))
{
    function get_session($session)
    {
        if (session()->has($session))
        {
            return
                "<div class=\"alert alert-success\">"
                . session()->get($session)
                . "</div>";
        } else {
            return "";
        }
    }
}
?>