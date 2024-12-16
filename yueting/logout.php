<?php
session_start();
$_SESSION= array();
session_unset();
session_destroy();

if(ini_get('seeion.use_cookies')){

    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}
/*remember me cookie löschen*/ 

if(isset($_COOKIE['username'])){
    setcookie('username','', time() - 3600, '/'); ;
}

/*weiterleitung zur startseite */
header('Location: index.php');
exit;
?>