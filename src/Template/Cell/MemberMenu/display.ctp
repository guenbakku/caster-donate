<li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
        <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
            'class' => 'img-circle', 
            'alt' => __('Ảnh đại diện'),
            'width' => 36
        ]) ?>
        <b class="hidden-xs"><?= h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')) ?></b>
    </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <li>
            <div class="dw-user-box">
                <div class="u-img">
                <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                    'alt' => __('Ảnh đại diện'),
                ]) ?>
                </div>
                <div class="u-text">
                    <h4><?= h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')) ?></h4>
                    <p class="text-muted"><?= h($this->Auth->user('profile.email') ?:__('Chưa cập nhật email')) ?></p>
                    <?= $this->Html->link(
                        __d('CakeDC/Users', 'Profile'),
                        '/me',
                        ['class' => 'btn btn-rounded btn-danger btn-sm']
                    ) ?>
                </div>
            </div>
        </li>
        <li>
            <div class="col-md-12">
                <span><i class="mdi mdi-wallet fa-fw"></i> <?=__('Số dư trong ví')?></span>
                <span class="pull-right"> 105.540VND</span>
            </div>
        </li>
        <li>
            <div class="col-md-12">
                <span><i class="mdi mdi-eye-outline fa-fw"></i> <?=__('Số người Follow')?></span>
                <span class="pull-right"> 142 người</span>
            </div>
        </li>
        <li>
            <div class="col-md-12">
                <span><i class="mdi mdi-key fa-fw"></i> <?=__('Trạng thái')?></span>
                <span class="pull-right"> <a class="text-success">Bình thường</a> / <a class="text-danger">Khóa</a></span>
            </div>
        </li>
        <li>
            <?= $this->Html->link(
                __d('CakeDC/Users', 'Logout'), 
                '/logout',
                ['class' => 'pull-right']
            ) ?>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>