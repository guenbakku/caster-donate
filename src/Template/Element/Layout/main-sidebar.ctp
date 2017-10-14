<aside class="main-sidebar">
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
    <!-- /.sidebar -->
</aside>