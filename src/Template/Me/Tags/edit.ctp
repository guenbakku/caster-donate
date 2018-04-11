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
                'read' => $this->Url->build([
                    'prefix' => 'api/v1',
                    'controller' => 'Tags',
                    'action' => 'getByName'
                ]),
                'preSelected' => $this->Url->build([
                    'prefix' => 'api/v1',
                    'controller' => 'Tags',
                    'action' => 'getByUserId',
                    $this->Auth->user('id')
                ]),
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
            'class' => 'fcbtn btn btn-outline btn-success miw-100',
            'label' => false,
            'type' => 'submit'
        ]) ?>

    <?= $this->Form->end() ?>
</div>
