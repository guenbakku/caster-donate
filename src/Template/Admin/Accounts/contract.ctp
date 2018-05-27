<?php
use Cake\Utility\Hash;
?>

<div class="white-box">
    <?= $this->element('Admin/Accounts/nav_tabs', ['userId' => $userId]) ?>

    <div class="tab-content wide-row">
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Trạng thái') ?></strong>
            </div>
            <div class="col-md-8">
                <span class="label label-<?= $contract->contract_status->bootstrap_class ?>">
                    <?= $contract->contract_status->name ?>
                </span> 
            </div>
        </div>

        <hr>
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
        <div class="row">
            <div class="col-md-offset-2 col-md-3 col-sm-4">
                Test1
            </div>
            <div class="col-md-3 col-sm-4">
                Test2
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
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Ảnh thẻ ngân hàng') ?></strong>
            </div>
            <div class="col-md-3 col-sm-4">
                Test1
            </div>
        </div>
    </div>

</div>