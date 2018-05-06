<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li>
                <a class="waves-effect" href="<?= $this->Url->build(['prefix' => 'admin', 'controller' => 'dashboard', 'action' => 'index']) ?>">
                    <i class="fa-fw mdi mdi-chart-areaspline"></i> <span class="hide-menu"><?= __('Thống kê') ?></span>
                </a>
            </li>
            <li> 
                <a href="javascript:void(0)" class="waves-effect">
                    <i class="fa-fw mdi mdi-account-multiple" data-icon="v"></i> 
                    <span class="hide-menu"><?= __('Thành viên') ?> <span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> 
                        <a class="waves-effect" href="<?= $this->Url->build(['prefix' => 'admin', 'controller' => 'Accounts', 'action' => 'index']) ?>">
                            <i class="fa-fw mdi mdi-account"></i> <span class="hide-menu"><?= __('Tài khoản') ?></span>
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect" href="<?= $this->Url->build(['prefix' => 'admin', 'controller' => 'Contracts', 'action' => 'index']) ?>">
                            <i class="fa-fw mdi mdi-content-paste"></i> <span class="hide-menu"><?= __('Hợp đồng') ?></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>