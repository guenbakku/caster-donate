<?= $this->element('/Me/Contracts/edit_contract_header') ?>

<div class="white-box">
    <?php $this->Form->setTemplates($FormTemplates['input-short']);?>
    <?=$this->Form->create($contract, [
        'type' => 'file',
        'class' => 'form-horizontal',
    ]);?>
        <h4 class="m-t-0"><?= __('Thông tin cá nhân') ?></h4>
        <?= $this->Form->control('firstname', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Họ và tên đệm'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('lastname', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Tên'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('sex_id', [
            'class' => 'form-control',
            'empty' => true,
            'options' => $this->Code->setTable('sexes')->getList(),
            'label' => [
                'text' => __('Giới tính'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('birthday', [
            'class' => 'form-control',
            'type'  => 'text',
            'data-mask' => "99/99/9999",
            'placeholder' => 'dd/mm/yyyy',
            'label' => [
                'text' => __('Ngày sinh'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('address', [
            'class' => 'form-control',
            'type'  => 'text',
            'label' => [
                'text' => __('Địa chỉ'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('phone', [
            'class' => 'form-control',
            'type'  => 'text',
            'label' => [
                'text' => __('Số điện thoại'),
                'class' => 'required',
            ],
        ]) ?>

        <hr>
        <h4 class="m-t-0"><?= __('Tài khoản ngân hàng') ?></h4>
        <?= $this->Form->control('bank_account.bank', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Tên ngân hàng'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('bank_account.branch', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Tên chi nhánh'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('bank_account.holder', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Tên chủ tài khoản'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->Form->control('bank_account.number', [
            'class' => 'form-control',
            'label' => [
                'text' => __('Số tài khoản'),
                'class' => 'required',
            ],
        ]) ?>
        <?= $this->cell('DragDropArea', [
            $this, 
            'bank_card',
            [
                'label' => [
                    'text' => __('Ảnh thẻ ngân hàng'),
                    'class' => 'required',
                ]
            ],
        ]) ?>

        <hr>
        <h4 class="m-t-0"><?= __('Chứng minh nhân dân') ?></h4>
        <?= $this->cell('DragDropArea', [
            $this, 
            'identify_card_front',
            [
                'label' => [
                    'text' => __('Mặt trước'),
                    'class' => 'required',
                ]
            ],
        ]) ?>
        <?= $this->cell('DragDropArea', [
            $this, 
            'identify_card_back',
            [
                'label' => [
                    'text' => __('Mặt sau'),
                    'class' => 'required',
                ]
            ],
        ]) ?> 

        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <?= $this->Html->link( __('Quay lại'), [
                    'action' => 'view',
                ], [
                    'class' => 'fcbtn btn btn-outline btn-default miw-100',
                ]) ?>
                <?= $this->Form->button( __('Tiếp'), [
                    'class' => 'fcbtn btn btn-outline btn-success miw-100',
                    'label' => false,
                    'type' => 'submit'
                ]) ?>
            </div>
        </div>

    <?= $this->Form->end() ?>
</div>
