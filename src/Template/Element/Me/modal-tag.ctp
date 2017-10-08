<div class="modal fade" id="caster-tag" tabindex="-1" role="dialog" aria-labelledby="caster-tag">
    <div class="modal-dialog" role="document">
        <?php $this->Form->setTemplates($FormTemplates['tag']); ?>
        <?=$this->Form->create($profile, [
            'id' => 'edit-tag-form',
            'class' => 'modal-content form-vertical',
            'url' => ['action' => 'tag'],
        ])?>
            <?php $this->Form->unlockField('multiselectTagData') ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="caster-tag-label"><?= __('Tag Live Stream') ?></h4>
            </div>
            <div class="modal-body">
                <p class="box-title"><?= __('Nhập tag Live stream bạn muốn theo dõi') ?></p>
                <?= $this->cell('MultipleSelect', [
                    $this,
                    'tranport' => [
                        'read' => $this->Url->build('/api/v1/tags/get-by-name'),
                        'preSelected' => $this->Url->build('/api/v1/tags/get-by-user-id/'.$Auth->user('id')),
                    ],
                    'input' => [
                        'value' => $profile->caster_tags,
                        'name' => 'caster_tags',
                        'class' => 'form-control',
                        'label' => false,
                    ]
                ]) ?> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= $this->Form->button(__('Gửi'), [
                    'class' => 'btn btn-primary',
                    'label' => false,
                ]) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>