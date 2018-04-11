<div class="col-md-6 col-md-offset-3">
    <div class="white-box">
        <h3 class="box-title text-center text-info">
            <span class="text-info"><i class="mdi mdi-content-copy"></i> <?= __('Chưa làm hợp đồng') ?></span>
        </h3>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">
                <p><?= __('Bạn cần đăng ký hợp đồng làm caster trước khi sử dụng chức năng này.') ?></p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <?= $this->Html->link(
                    __('Đăng ký hợp đồng'), 
                    [
                        'controller' => 'Contract',
                        'action' => 'term',
                    ],
                    [
                        'class' => 'fcbtn btn btn-outline btn-success',
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>