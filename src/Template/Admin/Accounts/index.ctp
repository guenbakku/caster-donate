<?php
use Cake\Utility\Hash;
?>

<div class="row">
    <div class="col-md-12">
        <?php $this->Form->setTemplates($FormTemplates['search-original']);?>
        <?= $this->Form->create(null, [
            'type' => 'get',
            'class' => 'panel panel-info',
        ]) ?>
            <div class="panel-heading"><?= __('Tìm kiếm') ?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= $this->Form->control('username', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => __('Tên đăng nhập'),
                            'default' => $this->request->getQuery('username'),
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('email', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => __('Địa chỉ email'),
                            'default' => $this->request->getQuery('email'),
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('status_id', [
                            'class' => 'form-control',
                            'options' => $this->Code->setTable('ContractStatuses')->getList(),
                            'empty' => __('Tất cả'),
                            'label' => __('Tình trạng hợp đồng'),
                            'default' => $this->request->getQuery('status_id'),
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?= $this->Html->link(__('Reset'), [
                            'action' => 'index',
                        ], [
                            'class' => 'fcbtn btn btn-outline btn-primary m-r-10 miw-100',
                        ]) ?>
                        <?= $this->Form->button(__('Tìm kiếm'), [
                            'class' => 'fcbtn btn btn-outline btn-info miw-100',
                            'label' => false,
                            'type' => 'submit'
                        ]) ?>
                    </div>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?= $this->element('Layout/admin/paginator') ?>
<div class="row m-t-5">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><?= __('Kết quả') ?></div>
            <div class="table-responsive">
                <?php if ($this->Paginator->counter('{{count}}') >0 ) : ?>
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th width="70" class="text-center">#</th>
                                <th><?= $this->Paginator->sort('Users.username', h(__('Tên đăng nhập'))) ?></th>
                                <th><?= $this->Paginator->sort('Users.email', h(__('Địa chỉ email'))) ?></th>
                                <th><?= $this->Paginator->sort('ContractStatuses.name', h(__('Tình trạng hợp đồng'))) ?></th>
                                <th><?= $this->Paginator->sort('Users.is_superuser', h(__('Super user'))) ?></th>
                                <th><?= $this->Paginator->sort('Users.activation_date', h(__('Thời điểm kích hoạt'))) ?></th>
                                <th width="150"><?= ('Quản lý') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($accounts as $i => $account): ?>
                                <tr>
                                    <td class="text-center"><?= $i+1 ?></td>
                                    <td><?= $account->username ?></td>
                                    <td><?= $account->email ?></td>
                                    <td><?= $account->contract->contract_status->name ?></td>
                                    <td><?= $account->is_superuser? '<i class="fa fa-check text-success"></i>' : '' ?></td>
                                    <td><?= $this->Time->format($account->activation_date, [\IntlDateFormatter::SHORT, null]) ?></td>
                                    <td>
                                        <?= $this->Html->link('<i class="ti-pencil-alt"></i>', [
                                            'action' => 'view',
                                            $account->id,
                                        ], [
                                            'class' => 'btn btn-info btn-outline btn-circle m-r-5',
                                            'escape' => false,
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="panel-body text-center"><?= __('Không tìm thấy kết quả.') ?></div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>