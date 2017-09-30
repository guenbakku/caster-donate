<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?= $this->Html->image($profile->avatar, [
                    'class' => 'profile-user-img img-responsive img-circle', 
                    'alt' => __d('CakeDC/Users', 'User profile picture')
                ]) ?>
                <h3 class="profile-username text-center"><?= $profile->nickname != null ?: $Auth->user('username') ?></h3>
                <p class="text-muted text-center"><?=__('Tham gia từ')?> : <?= $profile->created->i18nFormat([\IntlDateFormatter::LONG, \IntlDateFormatter::NONE]) ?></p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?=__('Ngày sinh')?></b> <span class="pull-right"><?= $profile->birthday ?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?=__('Nơi ở hiện tại')?></b> <span class="pull-right"><?= $profile->location ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Facebook</b> <span class="pull-right"><?= $profile->facebook ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Zalo</b> <span class="pull-right"><?= $profile->zalo_public ?></span>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"><b><?=__('Theo dõi')?></b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?=__('Về tôi')?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> <?=__('Lời giới thiệu')?></strong>
                <p class="text-muted">
                    <?= $profile->introduction ?>
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> <?=__('Tag Live Stream')?></strong>
                <p>
                    <span class="label label-danger">Dota 2</span>
                    <span class="label label-success">Lol</span>
                    <span class="label label-info">Học tiếng Nhật</span>
                </p>
                <hr>
                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                    <?= $this->Html->link(__('Thông kê thu nhập'), [
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