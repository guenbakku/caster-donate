<?php
use Cake\Utility\Hash;
use App\Utility\Flysystem;

$this->EmbedAsset->setConfig('filesystem.adapter', Flysystem::getAdapter('local'));
?>

<div class="white-box wide-row">
    <div class="row">
        <div class="col-md-12">
            <?php $selector = Hash::get($contract, 'contract_status.selector'); ?>
            <span class="label label-<?= Hash::get($contract, 'contract_status.bootstrap_class') ?>">
                <?= Hash::get($contract, 'contract_status.name') ?>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div>
                <?= Hash::get($contract, 'contract_status.description') ?>
            </div>
        </div>
    </div>
</div>

<div class="white-box wide-row">

    <?php if ($selector === 'inadequacy'): ?>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Html->link(__('Chỉnh sửa'), ['action' => 'edit'], [
                    'class' => 'fcbtn btn btn-outline btn-success',
                ]) ?>
            </div>
        </div>
        <hr>
    <?php endif?>

    <?php if ($selector === 'valid'): ?>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $icon = $this->Html->tag('i', ' ', [
                        'class' => 'ti-download',
                    ]) 
                ?>
                <?= $this->Html->link($icon.__('Tải về'), 
                    ['action' => 'download'], [
                    'class' => 'fcbtn btn btn-outline btn-success',
                    'escape' => false,
                ]) ?>
            </div>
        </div>
        <hr>
    <?php endif?>

    <h4 class="m-t-0"><?= __('Thông tin cá nhân') ?></h4>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Họ và tên') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'firstname') . ' ' . Hash::get($contract, 'lastname')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Giới tính') ?></strong>
        </div>
        <div class="col-md-8">
            <?= Hash::get($this->Code->setTable('sexes')->getList(), Hash::get($contract, 'sex_id')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Ngày sinh') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'birthday')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Địa chỉ') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'address')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Số điện thoại') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'phone')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Số CMND') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'identify_no')) ?>
        </div>
    </div>

    <hr>
    <h4 class="m-t-0"><?= __('Tài khoản ngân hàng') ?></h4>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Tên ngân hàng') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'bank_account.bank')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Tên chi nhánh') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'bank_account.branch')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Tên chủ tài khoản') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'bank_account.holder')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <strong><?= __('Số tài khoản') ?></strong>
        </div>
        <div class="col-md-8">
            <?= h(Hash::get($contract, 'bank_account.number')) ?>
        </div>
    </div>
</div>
