<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="javascript::void(0)" class="waves-effect active">
                            <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                                'class' => 'img-circle', 
                                'alt' => __('User profile picture'),
                            ]) ?>
                            <span class="hide-menu"> <?= h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')) ?>
                                <span class="fa arrow"></span>
                            </span>
                        </a>
                        <ul class="nav nav-second-level" aria-expanded="false" style="height: 0px;">
                            <li><a href="/me/profile"><i class="ti-user"></i> <span class="hide-menu"><?=__('Thông tin tài khoản')?></span></a></li>
                            <li><a href="/me/contract"><i class="ti-wallet"></i> <span class="hide-menu"><?=__('Hợp đồng Lên Sóng')?></span></a></li>
                            <li><a href="/me/withdraw"><i class="ti-wallet"></i> <span class="hide-menu"><?=__('Rút tiền')?></span></a></li>
                            <li><a href="/logout"><i class="fa fa-power-off"></i> <span class="hide-menu"><?=__('Đăng xuất')?></span></a></li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-av-timer fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Thống kê')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="me/"><i class=" fa-fw"></i><span class="hide-menu"><?=__('Thu nhập')?></span></a> </li>
                            <li> <a href="me/"><i class=" fa-fw"></i><span class="hide-menu"><?=__('Lượt donate')?></span></a> </li>
                            <li> <a href="me/"><i class=" fa-fw"></i><span class="hide-menu"><?=__('Người theo dõi')?></span></a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="fa fa-gift"></i> 
                            <span class="hide-menu"> <?=__('Donate')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="me/"><i class="fa fa-bell-o"> </i><span class="hide-menu"><?=__('Thông báo Donate')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-bullseye"> </i><span class="hide-menu"><?=__('Mục tiêu Donate')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-list-ol"> </i><span class="hide-menu"><?=__('BXH Donate')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-user"> </i><span class="hide-menu"><?=__('Người Donate gần nhất')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-user"> </i><span class="hide-menu"><?=__('Người Donate nhiều nhất')?></span></a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="fa fa-youtube-play"></i> 
                            <span class="hide-menu"> <?=__('Thông báo Youtube')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="me/"><i class="fa fa-users"> </i><span class="hide-menu"><?=__('Số người Subscribe')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-bell-o"> </i><span class="hide-menu"><?=__('Thông báo Subscribe')?></span></a> </li>
                            <li> <a href="me/"><i class="fa fa-bullseye"> </i><span class="hide-menu"><?=__('Mục tiêu Subscribe')?></span></a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="fa fa-calendar"></i> 
                            <span class="hide-menu"> <?=__('Lịch LiveStream')?></span>
                        </a>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="fa fa-windows"></i> 
                            <span class="hide-menu"> <?=__('Tạo cửa sổ thông báo riêng')?></span>
                        </a>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-av-timer fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Chi tiết về dịch vụ')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript::void(0)"><i class="fa fa-exclamation"> </i> <span class="hide-menu"><?=__('Điều khoản')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="fa fa-dollar" ></i> <span class="hide-menu"><?=__('Biểu phí')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="fa fa-envelope-o"> </i> <span class="hide-menu"><?=__('Liên hệ')?></span></a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
<!--<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu">


        <li class="header"><?=__('QUẢN LÝ TÀI KHOẢN')?></li>
        <li class="treeview <?=(in_array($this->request->action,['statistics']))?'active':'' ?>">
            <a href="#">
                <i class="fa fa-bar-chart"></i> <span><?=__('Thống kê')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="/me/statistics"><i class="fa fa-circle-o"></i> <?=__('Thu nhập')?></a></li>
                <li><a href="/me/statistics"><i class="fa fa-circle-o"></i> <?=__('Lượt donate')?></a></li>
                <li><a href="/me/statistics"><i class="fa fa-circle-o"></i> <?=__('Người theo dõi')?></a></li>
            </ul>
        </li>
        <li class="">
            <a href="">
                <i class="fa fa-money"></i> <span><?=__('Rút tiền')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class=""><a href=""><i class="fa fa-circle-o"></i> <?=__('Đặt lệnh')?></a></li>
                <li class=""><a href=""><i class="fa fa-circle-o"></i> <?=__('Lịch sử')?></a></li>
            </ul>
        </li>
        <li class="treeview <?=(in_array($this->request->action,['profile','contract']))?'active':'' ?>">
            <a href="#">
                <i class="fa fa-id-card-o" aria-hidden="true"></i> <span><?=__('Tài khoản')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?=($this->request->action=='profile')?'active':''?>"><a href="/me/profile"><i class="fa fa-circle-o"></i> <?=__('Thông tin tài khoản')?></a></li>
                <li class="<?=($this->request->action=='contract')?'active':''?>"><a href="/me/contract"><i class="fa fa-circle-o"></i> <?=__('Thông tin Lên Sóng')?></a></li>
            </ul>
        </li>
        <li class="<?=(in_array($this->request->action,['schedule']))?'active':'' ?>">
            <a href="/me/schedule">
                <i class="fa fa-calendar"></i> <span><?=__('Lịch LiveStream')?></span>
            </a>
        </li>


        <li><hr></li>
        <li class="header"><?=__('THIẾT LẬP LIVESTREAM')?></li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-bell-o"></i>
                <span><?=__('Cửa sổ thông báo Donate')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Thông báo Donate')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Lịch LiveStream')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Mục tiêu Donate')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('BXH Donate')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Người Donate gần nhất')?></a></li>
            </ul>
        </li>
        <li>
            <a href="">
                <i class="fa fa-youtube"></i> <span><?=__('Cửa sổ thông báo Youtube')?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Số người Subscriber')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Thông báo Subscriber')?></a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> <?=__('Mục tiêu Subscriber')?></a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-pencil-square-o"></i>
                <span><?=__('Tạo cửa sổ thông báo riêng')?></span>
            </a>
        </li>



        <li><hr></li>
        <li class="header"><?=__('CHI TIẾT VỀ DỊCH VỤ')?></li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-exclamation"></i>
                <span><?=__('Điều khoản')?></span>
            </a>
        </li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-dollar"></i>
                <span><?=__('Biểu phí')?></span>
            </a>
        </li>
        <li class="treeview">
            <a href="">
                <i class="fa fa-envelope-o"></i>
                <span><?=__('Liên hệ')?></span>
            </a>
        </li>

    </ul>
    </section>
</aside>-->