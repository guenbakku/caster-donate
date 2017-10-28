<li class="dropdown">
    <a class="dropdown-toggle profile-pic waves-effect waves-light" data-toggle="dropdown" href="#">
        <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
            'class' => 'img-circle', 
            'alt' => __('Ảnh đại diện'),
            'width' => 36
        ]) ?>
        <b class="hidden-xs"><?= $this->Text->truncate(h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')), 25) ?></b>
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
                    <h4><?= $this->Text->truncate(h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')), 17)?></h4>
                    <p class="text-muted"><?= $this->Text->truncate(h($this->Auth->user('email') ?: __('Chưa cập nhật email')), 20) ?></p>
                    <?= $this->Html->link(
                        __d('CakeDC/Users', 'Profile'),
                        '/me',
                        ['class' => 'btn btn-rounded btn-danger btn-sm']
                    ) ?>
                </div>
            </div>
        </li>
        <li role="separator" class="divider"></li>
        <li>
            <a><i class="icon-wallet"></i> 105.540VND</a>
        </li>
        <li role="separator" class="divider"></li>
        <li>
            <?= $this->Html->link(
                '<i class="icon-power"></i> ' . __d('CakeDC/Users', 'Logout'), 
                '/logout', 
                ['escape' => false]
            ) ?>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>