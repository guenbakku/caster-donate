    <nav class="navbar navbar-default navbar-static-top m-b-0 <?=($this->Auth->user())?'':'without-sidebar'?>">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="/">
                    <?= $this->Html->image('admin-logo.png', [
                            'class' => 'dark-logo', 
                            'alt' => __('home')
                        ]) ?>
                    <?= $this->Html->image('admin-logo-dark.png', [
                            'class' => 'light-logo', 
                            'alt' => __('home')
                        ]) ?>
                    </b>
                    <span class="hidden-xs">
                        <span class="dark-logo"><?= Cake\Core\Configure::read('System.sitename') ?></span>
                        <span class="light-logo"><?= Cake\Core\Configure::read('System.sitename') ?></span>
                    </span> 
                </a>
            </div>
            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <?php if($this->Auth->user()){
                    echo '<li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>';
                }?>
                <li>
                    <a class="hidden-xs" href="">Hướng dẫn</a>
                    <a class="visible-xs" href=""><i class="mdi mdi-book-open-page-variant"></i></a>
                </li>
                <li>
                    <a class="hidden-xs" href="">Liên hệ</a>
                    <a class="visible-xs" href=""><i class="mdi mdi-email-outline"></i></a>
                </li>
                <li>
                    <a class="hidden-xs" href="">Điều khoản</a>
                    <a class="visible-xs" href=""><i class="mdi mdi-alert-octagram"></i></a>                    
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="mdi mdi-gmail"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                    <ul class="dropdown-menu mailbox animated bounceInDown">
                        <li>
                            <div class="drop-title">You have 4 new messages</div>
                        </li>
                        <li>
                            <div class="message-center">
                                <a href="#">
                                    <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                </a>
                                <a href="#">
                                    <div class="user-img"> <img src="../plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                </a>
                                <a href="#">
                                    <div class="user-img"> <img src="../plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                </a>
                                <a href="#">
                                    <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                    <div class="mail-contnet">
                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                        <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                </li>
                <?php 
                    if (empty($this->Auth->user())) {
                        echo $this->cell('GuestMenu');
                    } else {
                        echo $this->cell('MemberMenu');
                    }
                ?>
                
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>