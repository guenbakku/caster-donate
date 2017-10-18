        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="javascript::void(0)" class="waves-effect <?=(in_array($this->request->action,['profile','contract','withdraw']))?'active':''?>">
                            <?= $this->Html->image($this->Auth->user('profile.avatar_url'), [
                                'class' => 'img-circle', 
                                'alt' => __('User profile picture'),
                            ]) ?>
                            <span class="hide-menu"> <?= h($this->Auth->user('profile.nickname') ?: $this->Auth->user('username')) ?>
                                <span class="fa arrow"></span>
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="/me/profile"><i class="mdi mdi-account-card-details"></i> <span class="hide-menu"><?=__('Thông tin tài khoản')?></span></a></li>
                            <li><a href="/me/contract"><i class="mdi mdi-receipt"></i> <span class="hide-menu"><?=__('Hợp đồng Lên Sóng')?></span></a></li>
                            <li><a href="/me/withdraw"><i class="mdi mdi-cash-100"></i> <span class="hide-menu"><?=__('Rút tiền')?></span></a></li>
                            <li><a href="/logout"><i class="mdi mdi-logout"></i> <span class="hide-menu"><?=__('Đăng xuất')?></span></a></li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect <?=(in_array($this->request->action,['statistics']))?'active':''?>">
                            <i class="mdi mdi-av-timer fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Thống kê')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="/me/statistics"><i class="mdi mdi-cash-usd fa-fw"></i> <span class="hide-menu"><?=__('Thu nhập')?></span></a> </li>
                            <li><a href="javascript::void(0)"><i class="mdi mdi-format-list-bulleted-type fa-fw"></i> <span class="hide-menu"><?=__('Lượt donate')?></span></a> </li>
                            <li><a href="javascript::void(0)"><i class="mdi mdi-eye-outline fa-fw"></i> <span class="hide-menu"><?=__('Người theo dõi')?></span></a> </li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-gift fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Thiết lập Donate')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-bell-ring fa-fw"></i> <span class="hide-menu"><?=__('Thông báo Donate')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-target fa-fw"></i> <span class="hide-menu"><?=__('Mục tiêu Donate')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-numeric fa-fw"></i> <span class="hide-menu"><?=__('BXH Donate')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-nature-people fa-fw"></i> <span class="hide-menu"><?=__('Người Donate gần nhất')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-crown fa-fw"></i> <span class="hide-menu"><?=__('Người Donate nhiều nhất')?></span></a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-youtube-play fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Thiết lập Youtube')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-bell-ring fa-fw"></i> <span class="hide-menu"><?=__('Thông báo Subscribe')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-target fa-fw"></i> <span class="hide-menu"><?=__('Mục tiêu Subscribe')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="fa fa-users fa-fw"></i> <span class="hide-menu"><?=__('Số người Subscribe')?></span></a> </li>
                        </ul>
                    </li>
                    <li> 
                        <a href="/me/schedule" class="waves-effect">
                            <i class="mdi mdi-calendar-check fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Lịch LiveStream')?></span>
                        </a>
                    </li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-windows fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Tạo cửa sổ riêng')?></span>
                        </a>
                    </li>
                    <li class="devider"></li>
                    <li> 
                        <a href="javascript::void(0)" class="waves-effect">
                            <i class="mdi mdi-leaf fa-fw"></i> 
                            <span class="hide-menu"> <?=__('Chi tiết về dịch vụ')?>
                                <span class="fa arrow"></span> 
                            </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-alert-octagram fa-fw"> </i> <span class="hide-menu"><?=__('Điều khoản')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-blur-linear fa-fw" ></i> <span class="hide-menu"><?=__('Biểu phí')?></span></a> </li>
                            <li> <a href="javascript::void(0)"><i class="mdi mdi-email fa-fw"> </i> <span class="hide-menu"><?=__('Liên hệ')?></span></a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>