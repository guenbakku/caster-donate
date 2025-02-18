<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<h1>500</h1>
<h3 class="text-uppercase"><?= h($message) ?></h3>
<p class="text-muted m-t-30 m-b-30"><?= __('Có lỗi xảy ra ở phía máy chủ. Chúng tôi đang cố gắng hết sức để khôi phục lại.') ?></p>
<?= $this->Html->link(__('Quay lại'), 'javascript:history.back()', [
    'class' => 'btn btn-danger btn-rounded waves-effect waves-light m-b-40'
]) ?>

