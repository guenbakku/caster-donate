<div class="modal fade" id="caster-tag" role="dialog" aria-labelledby="caster-tag">
    <div class="modal-dialog" role="document">
        <?php $this->Form->setTemplates($FormTemplates['tag']); ?>
        <?=$this->Form->create(null,[
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
                <?php 
                //     $this->cell('MultipleSelect', [
                //     $this,
                //     'tranport' => [
                //         'read' => $this->Url->build('/api/v1/tags/get-all'),
                //         'create' => $this->Url->build('/api/v1/tags/create'),
                //     ],
                //     'options' => [
                //         'value' => $profile->caster_tags,
                //         'name' => 'caster_tags'
                //     ]
                // ]) 
                ?>
                
                <?php 
                    $this->start('script');
                    echo $this->fetch('script');
                ?>
                    <script type="text/javascript">
                        $('select').select2();
                    </script>

                <?php $this->end() ?>
                
                <?= $this->Form->control('caster_tags', [
                    'type' => 'select',
                    'options' => ['1' => 'test1', '2' => 'test2', '3' => 'test3'],
                    'class' => 'form-control',
                    'multiple' => true,
                    'label' => false,
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