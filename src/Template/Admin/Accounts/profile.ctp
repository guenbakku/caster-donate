<div class="white-box">
    <?= $this->element('Admin/Accounts/nav_tabs', ['userId' => $userId]) ?>

    <div class="tab-content wide-row">
        <h4 class="m-t-0"><?= __('Thông tin cơ bản') ?></h4>
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Tên đăng nhập') ?></strong>
            </div>
            <div class="col-md-8">
                <?= $profile->user->username ?>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Email') ?></strong>
            </div>
            <div class="col-md-8">
                <?= $profile->user->email ?>     
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Nickname') ?></strong>
            </div>
            <div class="col-md-8">
                <?= $profile->nickname ?>         
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <strong><?= __('Lời giới thiệu') ?></strong>
            </div>
            <div class="col-md-8">
                <?= $profile->introduction ?>        
            </div>
        </div>
        <hr>
        <h4 class="m-t-0"><?= __('Mạng xã hội') ?></h4>
        <?php foreach ($profile->social_providers as $i => $socialProvider): ?>
        <div class="row">
            <div class="col-md-2">
                <strong><?= $socialProvider->name ?></strong>
            </div>
            <div class="col-md-8">
                <?= $socialProvider->_joinData->reference ?>        
            </div>
        </div>
        <?php endforeach ?>

    </div>

</div>