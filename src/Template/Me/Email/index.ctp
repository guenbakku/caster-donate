<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-md-2 control-label">
                <label><?= __('Địa chỉ email') ?></label>
            </div>
            <div class="col-md-6 control-label" style="text-align: left">
                <label><strong><?= $user->email ?></strong></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Html->link(__('Sửa'), 
                    ['action' => 'edit'],
                    ['class' => 'btn btn-success miw-100']
                ); ?>
            </div>
        </div>
    </div>
</div>
