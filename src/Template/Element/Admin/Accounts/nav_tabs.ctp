<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="">
        <?php $url = $this->Url->build(['action' => 'view', 'profile', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="ti-home"></i></span>
            <span class="hidden-xs"><?= __('Thông tin cá nhân') ?></span>
        </a>
    </li>
    <li role="presentation">
        <?php $url = $this->Url->build(['action' => 'view', 'contract', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="ti-user"></i></span>
            <span class="hidden-xs"><?= __('Thông tin hợp đồng') ?></span>
        </a>
    </li>
    <li role="presentation" class="">
        <?php $url = $this->Url->build(['action' => 'view', 'login-log', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="ti-email"></i></span> 
            <span class="hidden-xs"><?= __('Lịch sử đăng nhập') ?></span>
        </a>
    </li>
</ul>