<div class="row">
    <div class="col-md-12">
        <?php $this->Form->setTemplates($FormTemplates['admin-search-box']);?>
        <?= $this->Form->create(null, [
            'type' => 'get',
            'class' => 'panel',
        ]) ?>
            <div class="panel-heading panel-h"><?= __('Tìm kiếm') ?></div>
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
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading"><?= __('Kết quả') ?></div>
            <div class="table-responsive">
                <table class="table table-hover manage-u-table">
                    <thead>
                        <tr>
                            <th width="70" class="text-center">#</th>
                            <th>NAME</th>
                            <th>OCCUPATION</th>
                            <th>EMAIL</th>
                            <th>ADDED</th>
                            <th width="250">CATEGORY</th>
                            <th width="300">MANAGE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Daniel Kristeen
                                <br><span class="text-muted">Texas, Unitedd states</span></td>
                            <td>Visual Designer
                                <br><span class="text-muted">Past : teacher</span></td>
                            <td>daniel@website.com
                                <br><span class="text-muted">999 - 444 - 555</span></td>
                            <td>15 Mar 1988
                                <br><span class="text-muted">10: 55 AM</span></td>
                            <td>
                                <select class="form-control">
                                    <option>Modulator</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                    <option>Subscriber</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-key"></i></button>
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-trash"></i></button>
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-pencil-alt"></i></button>
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-20"><i class="ti-upload"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>