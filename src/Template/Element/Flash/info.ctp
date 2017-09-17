<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = nl2br(h($message));
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-info"></i> <?= __('Info') ?></h4>
    <?= $message ?>
</div>