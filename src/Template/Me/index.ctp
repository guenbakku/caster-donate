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
                        <strong><i class="fa fa-pencil margin-r-5"></i> <?=__('Tag nội dung Live Stream')?></strong>
                        <?=$this->Form->create()?>
                        <div class="input-group input-group-sm">
                            <?=$this->Form->input('tag_name',[
                                'type' => 'text',
                                'class' => '',
                                'id' => 'products',
                                'label' => false
                            ])?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat"><?=__('Thêm Tag')?></button>
                            </span>
                        </div>
                        <?=$this->Form->end()?>
                        
                        <script id="noDataTemplate" type="text/x-kendo-tmpl">
                            <div>
                                 <?=__('Không tìm thấy tag, bạn có muốn tạo tag mới không ?:')?>- '#: instance.input.val() #' ?
                            </div>
                            <br />
                            <button class="k-button" onclick="addNew('#: instance.element[0].id #', '#: instance.input.val() #')"><?=__('Tạo tag mới')?></button>
                        </script>

                        <div>
                            <span class="label label-danger">Dota 2</span>
                            <span class="label label-success">Lol</span>
                            <span class="label label-info">Học tiếng Nhật</span>
                        </div>
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
                <li class="<?= $this->request->action == 'register'? 'active' : null ?>">
                    <?= $this->Html->link(__('Đăng ký Lên Sóng'), [
                        'action' => 'register',
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