<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?= $this->Html->image($Auth->user('avatar_url'), [
                    'class' => 'profile-user-img img-responsive img-circle', 
                    'alt' => __d('CakeDC/Users', 'User profile picture')
                ]) ?>
                <h3 class="profile-username text-center"><?= $profile->nickname?: $Auth->user('username') ?></h3>
                <p class="text-muted text-center"><?=__('Tham gia từ')?> : <?= $Auth->user('created')->i18nFormat([\IntlDateFormatter::LONG, \IntlDateFormatter::NONE]) ?></p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?=__('Ngày sinh')?></b> <span class="pull-right"><?= h($profile->birthday) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?=__('Nơi ở hiện tại')?></b> <span class="pull-right"><?= h($profile->location) ?></span>
                    </li>

                    <?php foreach ($profile->social_providers as $socialProvider): ?>
                    <li class="list-group-item">
                        <b><?= $socialProvider->name ?></b>
                        <?php if (!empty($socialProvider->_joinData->reference)) {
                            echo $this->Html->link(
                                $this->Text->truncate(h($socialProvider->_joinData->reference), 30), 
                                $socialProvider->_joinData->reference,
                                [
                                    'class' => 'pull-right',
                                    'escape' => false,
                                    'title' => $socialProvider->_joinData->reference,
                                    'target' => '_blank',
                                ]
                            ); 
                        } ?>
                    </li>
                    <?php endforeach ?>

                    <li class="list-group-item">
                        <strong><i class="fa fa-book margin-r-5"></i> <?=__('Lời giới thiệu')?></strong>
                        <div class="text-muted">
                            <?= nl2br(h($profile->introduction)) ?>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="fa fa-tag margin-r-5"></i> <?=__('Tag nội dung Live Stream')?></strong>
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
                        <div>
                            <?php foreach ($profile->caster_tags as $tag): ?>
                                <span class="label label-info"><i class="fa fa-tag"></i> <?= h($tag->name) ?></span>    
                            <?php endforeach ?>
                        </div>
                        <?= $this->element('Me/modal-tag') ?>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
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
                <li class="<?= $this->request->action == 'contact'? 'active' : null ?>">
                    <?php
                    $tab_name = (!$profile->caster_infos) ? __('Đăng ký Lên Sóng') : _("Thông tin Lên Sóng");
                    echo $this->Html->link($tab_name, [
                        'action' => 'contact',
                    ]) ?>
                </li>
            </ul>
            <div class="tab-content">
                <?= $this->element('Me/tab-'.$this->request->action) ?>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
<!-- /.col -->
</div>
<!-- /.row -->