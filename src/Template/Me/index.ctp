<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?= $this->Html->image($Auth->user('profile.avatar_url'), [
                    'class' => 'profile-user-img img-responsive img-circle', 
                    'alt' => __d('CakeDC/Users', 'User profile picture')
                ]) ?>
                <h3 class="profile-username text-center"><?= h($Auth->user('profile.nickname')) ?: h($Auth->user('username')) ?></h3>
                <p class="text-muted text-center"><?=__('Tham gia từ')?> : <?= $Auth->user('created')->i18nFormat([\IntlDateFormatter::LONG, \IntlDateFormatter::NONE]) ?></p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?=__('Ngày sinh')?></b> <span class="pull-right"><?= h($Auth->user('profile.birthday')) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?=__('Nơi ở hiện tại')?></b> <span class="pull-right"><?= h($Auth->user('profile.location')) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?=__('Tag nội dung Live Stream')?></b>
                        <?= $this->Form->button(
                            '<i class="fa fa-edit"></i> '.__('Sửa'),
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-xs pull-right',
                                'type' => 'button',
                                'data-toggle' => 'modal',
                                'data-target' => '#caster-tag'
                            ]
                        ) ?>
                        <div style="margin-top:5px">
                            <?php foreach ($Auth->user('profile.caster_tags') as $tag): ?>
                                <span class="label label-info"><i class="fa fa-tag"></i> <?= h($tag->name) ?></span>    
                            <?php endforeach ?>
                        </div>
                        <?= $this->element('Me/modal-tag') ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="<?= $this->request->action == 'statistics'? 'active' : null ?>">
                    <?= $this->Html->link(__('Thống kê thu nhập'), [
                        'action' => 'statistics',
                    ]) ?>
                </li>
                <li class="<?= $this->request->action == 'schedule'? 'active' : null ?>">
                    <?= $this->Html->link(__('Lịch Livestream'), [
                        'action' => 'schedule',
                    ]) ?>
                </li>
                <li class="<?= $this->request->action == 'profile'? 'active' : null ?>">
                    <?= $this->Html->link(__('Thông tin cá nhân'), [
                        'action' => 'profile',
                    ]) ?>
                </li>
                <li class="<?= $this->request->action == 'contract'? 'active' : null ?>">
                    <?php
                    echo $this->Html->link(__('Thông tin lên sóng'), [
                        'action' => 'contract',
                    ]) ?>
                </li>
            </ul>
            <div class="tab-content">
                <?= $this->element('Me/tab-'.$this->request->action) ?>
            </div>
        </div>
    </div>
</div>