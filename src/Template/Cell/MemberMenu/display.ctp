<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <?= $this->Html->image($Auth->user('avatar_url'), ['class' => 'user-image', 'alt' => __('User profile picture')]) ?>
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">
            <?= h($Auth->user('nickname') ?: $Auth->user('username')) ?>
        </span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <?= $this->Html->image($Auth->user('avatar_url'), ['class' => 'img-circle', 'alt' => __('User profile picture')]) ?>
            <p>
                <?= h($Auth->user('nickname') ?: $Auth->user('username')) ?>
                <small><?=__('Tham gia từ')?> : <?= $Auth->user('created')->i18nFormat([\IntlDateFormatter::LONG, \IntlDateFormatter::NONE]) ?></small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <?= $this->Html->link(
                    __d('CakeDC/Users', 'Profile'),
                    '/me',
                    ['class' => 'btn btn-default btn-flat']
                ) ?>
            </div>
            <div class="pull-right">
                <?= $this->Html->link(
                    __d('CakeDC/Users', 'Logout'), 
                    '/logout',
                    ['class' => 'btn btn-default btn-flat']
                ) ?>
            </div>
        </li>
    </ul>
</li>