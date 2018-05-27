<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="">
        <?php $url = $this->Url->build(['action' => 'view', 'profile', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="mdi mdi-account-card-details"></i></span>
            <span class="hidden-xs"><?= __('Thông tin cá nhân') ?></span>
        </a>
    </li>
    <li role="presentation">
        <?php $url = $this->Url->build(['action' => 'view', 'contract', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="mdi mdi-content-paste"></i></span>
            <span class="hidden-xs"><?= __('Thông tin hợp đồng') ?></span>
        </a>
    </li>
    <li role="presentation" class="">
        <?php $url = $this->Url->build(['action' => 'view', 'login-log', $userId]) ?>
        <a href="<?= $url ?>">
            <span class="visible-xs"><i class="mdi mdi-history"></i></span> 
            <span class="hidden-xs"><?= __('Lịch sử đăng nhập') ?></span>
        </a>
    </li>
</ul>