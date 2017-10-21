<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['tag']); ?>
    <?=$this->Form->create(null, [
        'id' => 'edit-tag-form',
        'class' => 'form-vertical',
        'type' => 'put',
    ])?>
        <?php $this->Form->unlockField('multiselectTagData') ?>

        <p><?= __('Nhập thể loại live stream bạn muốn theo dõi') ?></p>
        <?= $this->cell('MultipleSelect', [
            $this,
            'tranport' => [
                'read' => $this->Url->build('/api/v1/tags/get-by-name'),
                'preSelected' => $this->Url->build('/api/v1/tags/get-by-user-id/'.$this->Auth->user('id')),
            ],
            'input' => [
                // 'value' => $this->Auth->user('profile.caster_tags'),
                'name' => 'caster_tags',
                'class' => 'form-control',
                'label' => false,
            ]
        ]) ?> 

        <?= $this->Form->button( __('Cập nhật'),[
            'class' => 'btn btn-success',
            'label' => false,
            'type' => 'submit'
        ]) ?>

    <?= $this->Form->end() ?>
</div>
