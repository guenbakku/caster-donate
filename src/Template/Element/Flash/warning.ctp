<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = nl2br(h($message));
}
?>

<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-warning"></i> <?= __('Warning') ?></h4>
    <?= $message ?>
</div>