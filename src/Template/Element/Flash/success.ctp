<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = nl2br(h($message));
}
?>
<div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-success myadmin-alert-bottom flash-message-bottom"> 
    <p>
        <i class="mdi mdi-check-circle fa-fw"></i> <?= $message ?> <a href="#" class="closed">&times;</a> 
    </p>
</div>