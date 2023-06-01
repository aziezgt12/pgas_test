<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function checkNotActive($status = null)
{
    if ($status == 0) {
        return '<span class="badge badge-primary">Active</span>';
    } else {
        return '<span class="badge badge-danger">Not Active</span>';
    }
}

function getAlertBs($alertType, $message)
{
    $html = "<div class='alert alert-$alertType mb-2' role='alert'>
                <h4 class='alert-heading mt-0 font-18'>$alertType!</h4><hr>
                <p>$message</p>
            </div>";
    return $html;
}
