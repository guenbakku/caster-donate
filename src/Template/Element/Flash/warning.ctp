<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = nl2br(h($message));
}
?>

<div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-warning myadmin-alert-bottom flash-message-bottom"> 
    <p class="text-center">
        <i class="mdi mdi-alert fa-fw"></i> <?= $message ?> <a href="#" class="closed">&times;</a> 
    </p>
</div>