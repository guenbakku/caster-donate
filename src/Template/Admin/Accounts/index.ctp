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
                            'class' => 'form-control',
                            'label' => __('Tên đăng nhập'),
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'label' => __('Địa chỉ email'),
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('contract_status_id', [
                            'class' => 'form-control',
                            'options' => $this->Code->setTable('ContractStatuses')->getList(),
                            'empty' => __('Tất cả'),
                            'label' => __('Tình trạng hợp đồng'),
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

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><?= __('Kết quả') ?></div>
            <div class="table-responsive">
                <table class="table table-hover manage-u-table">
                    <thead>
                        <tr>
                            <th width="70" class="text-center">#</th>
                            <th><?= __('Tên đăng nhập') ?></th>
                            <th><?= __('Địa chỉ email') ?></th>
                            <th><?= __('Tình trạng hợp đồng') ?></th>
                            <th width="150"><?= ('Quản lý') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accounts as $account): ?>
                            <tr>
                                <td class="text-center">1</td>
                                <td><?= $account->username ?></td>
                                <td><?= $account->email ?></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-outline btn-circle m-r-5"><i class="ti-pencil-alt"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>