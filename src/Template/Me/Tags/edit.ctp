<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['tag']); ?>
    <?=$this->Form->create(null, [
        'id' => 'edit-tag-form',
        'class' => 'form-vertical',
        'type' => 'put',
    ])?>
        <?php $this->Form->unlockField('multiselectTagData') ?>

        <p><?= __('Nhập thể loại live stream bạn quan tâm') ?></p>
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
            ],
            'select2Option' =>[
                'minimumInputLength' => 2,
                'tags' => true, // Enable dynamic creation
                'language' => 'vi',
                'tokenSeparators' => [','],
            ],
        ]) ?> 

        <?= $this->Form->button( __('Gửi'),[
            'class' => 'btn btn-success miw-100',
            'label' => false,
            'type' => 'submit'
        ]) ?>

    <?= $this->Form->end() ?>
</div>
