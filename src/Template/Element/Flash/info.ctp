<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = nl2br(h($message));
}
?>
<div class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-info"> 
    <i class="mdi mdi-information fa-fw"></i> <?= $message ?> <a href="#" class="closed">&times;</a> 
</div>