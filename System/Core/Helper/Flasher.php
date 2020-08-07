<?php
namespace Core\Helper;

class Flasher {

    public static function set($message, $info , $action, $type){
        $_SESSION['flash'] = [
            'message' => $message,
            'info' => $info,
            'action' => $action,
            'type' => $type,
        ];
    }

    public static function get(){
        if (isset($_SESSION['flash'])):
            echo '
            <div class="alert alert-' . $_SESSION['flash']['type'] .' alert-dismissible fade show" role="alert">
                '. $_SESSION['flash']['message'] .' <strong>' . $_SESSION['flash']['info'] . '</strong> ' . $_SESSION['flash']['action'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            ';
            unset($_SESSION['flash']);
        endif;
    }
}