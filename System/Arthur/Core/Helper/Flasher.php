<?php
namespace Arthur\Core\Helper;

class Flasher {

    /**
     * @param string $message
     * @param string $info
     * @param string $action
     * @param string $type
     * @return void
     */
    public static function set(string $message, string $info , string $action, string $type): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'info' => $info,
            'action' => $action,
            'type' => $type,
        ];
    }

    public static function get(): void
    {
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