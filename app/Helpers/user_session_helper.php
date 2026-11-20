<?php
if (!function_exists('clear_current_user_session')) {
    function clear_current_user_session() {
        session()->remove('current_user');
        session()->regenerate();
    }
}
?>