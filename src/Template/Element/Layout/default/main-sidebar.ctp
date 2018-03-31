<?php
use Cake\Utility\Hash;

// Detect which group is active
$groupActiveMap = [
    'account' => ['Profile', 'Avatar', 'Email', 'Password', 'Tags'],
    'contract' =>  ['Contract', 'Withdraw'],
    'settings' => ['DonationSettings', 'Schedules'],
    'statistic' => ['Statistics'],
    // Other group - controller come here...
];
$groupActiveMatcher = function ($groupActiveMap) {
    $groupActive = [];
    if ($this->request->prefix === 'me') {
        $controller = $this->request->controller;
        foreach ($groupActiveMap as $group => $controllers) {
            if (in_array($controller, $controllers)) {
                $groupActive[$group] = 'active';
                break;
            }
        }
    }
    return $groupActive;
};
$groupActive = $groupActiveMatcher($groupActiveMap);
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close">
                    <i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span> <span class="hide-menu">
                    <?=__('Trang cá nhân')?>
                </span>
            </h3> 
        </div>
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="javascript::void(0)" class="waves-effect <?= Hash::get($groupActive, 'account')?>">
                    <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                        'class' => 'img-circle', 
                        'alt' => __('Ảnh đại diện'),
                    ]) ?>
                    <span class="hide-menu"> <?= $this->Text->truncate(h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')), 20) ?>
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="/me/profile/edit"><i class="mdi mdi-account-card-details"></i> <span class="hide-menu"><?=__('Thông tin cá nhân')?></span></a></li>
                    <li><a href="/me/avatar/edit"><i class="mdi mdi-account-circle"></i> <span class="hide-menu"><?=__('Ảnh đại diện')?></span></a></li>
                    <li><a href="/me/email"><i class="mdi mdi-email"></i> <span class="hide-menu"><?=__('Địa chỉ email')?></span></a></li>
                    <li><a href="/me/password/edit"><i class="mdi mdi-lock"></i> <span class="hide-menu"><?=__('Mật khẩu')?></span></a></li>
                    <li><a href="/me/tags/edit"><i class="mdi mdi-bookmark-music"></i> <span class="hide-menu"><?=__('Thể loại live stream')?></span></a></li>
                </ul>
            </li>
            <li> 
                <a href="/me/statistics" class="waves-effect <?= Hash::get($groupActive, 'statistic')?>">
                    <i class="mdi mdi-chart-areaspline fa-fw"></i> 
                    <span class="hide-menu"> <?=__('Thống kê')?> </span>
                </a>
            </li>
            <li> 
                <a href="javascript::void(0)" class="waves-effect <?= Hash::get($groupActive, 'contract')?>">
                    <i class="mdi mdi-content-paste fa-fw"></i> 
                    <span class="hide-menu"> <?=__('Hợp đồng & rút tiền')?>
                        <span class="fa arrow"></span> 
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="/me/contract"><i class="mdi mdi-content-copy"></i> <span class="hide-menu"><?=__('Hợp đồng')?></span></a></li>
                    <li><a href="/me/withdraw/edit"><i class="mdi mdi-cash-100"></i> <span class="hide-menu"><?=__('Rút tiền')?></span></a></li>
                </ul>
            </li>
            <li> 
                <a href="javascript::void(0)" class="waves-effect <?= Hash::get($groupActive, 'settings')?>">
                    <i class="mdi mdi-gift fa-fw"></i> 
                    <span class="hide-menu"> <?=__('Thiết lập')?>
                        <span class="fa arrow"></span> 
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="/me/donation-settings/notify"><i class="mdi mdi-bell-ring fa-fw"></i> <span class="hide-menu"><?=__('Thông báo Donate')?></span></a> </li>
                    <li> <a href="/me/schedules/index"><i class="mdi mdi-calendar-check fa-fw"></i> <span class="hide-menu"><?=__('Lịch LiveStream')?></span></a> </li> 
                    <li> <a href="javascript::void(0)"><i class="mdi mdi-windows fa-fw"></i> <span class="hide-menu"><?=__('Tạo cửa sổ cá nhân')?></span></a> </li> 
                </ul>
            </li>
        </ul>
    </div>
</div>