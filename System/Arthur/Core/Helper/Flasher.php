<?php
namespace Arthur\Core\Helper;

/**
 * @author Adam Arthur Faizal
 *
 **/
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
            if ($_SESSION['flash']['type'] === 'warning'):
                echo '
                <div class="mb-3 flex justify-between items-center bg-yellow-200 relative text-yellow-600 py-3 px-3 rounded-lg " role="alert">
                    <span>'. $_SESSION['flash']['message'] .' <strong>' . $_SESSION['flash']['info'] . '</strong> ' . $_SESSION['flash']['action'] . '</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
                ';
            elseif ($_SESSION['flash']['type'] === 'danger'):
                echo '
                <div class="mb-3 flex justify-between items-center bg-red-200 relative text-red-600 py-3 px-3 rounded-lg " role="alert">
                    <span>'. $_SESSION['flash']['message'] .' <strong>' . $_SESSION['flash']['info'] . '</strong> ' . $_SESSION['flash']['action'] . '</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
                ';
            elseif ($_SESSION['flash']['type'] === 'success'):
                echo '
                <div class="mb-3 flex justify-between items-center bg-green-200 relative text-green-600 py-3 px-3 rounded-lg " role="alert">
                    <span>'. $_SESSION['flash']['message'] .' <strong>' . $_SESSION['flash']['info'] . '</strong> ' . $_SESSION['flash']['action'] . '</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
                ';
            endif;
            unset($_SESSION['flash']);
        endif;
    }
}