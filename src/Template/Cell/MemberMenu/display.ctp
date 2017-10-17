<li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
        <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
            'class' => 'img-circle', 
            'alt' => __('User profile picture'),
            'width' => 36
        ]) ?>
        <b class="hidden-xs"><?= h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')) ?></b>
    </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <li>
            <div class="dw-user-box">
                <div class="u-img">
                <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                    'alt' => __('User profile picture'),
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
            <?= $this->Html->link(
                __d('CakeDC/Users', 'Logout'), 
                '/logout',
                ['class' => '']
            ) ?>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>