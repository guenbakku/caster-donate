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
                    echo '<li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i> </a></li>';
                }?>
                <li>
                    <a class="hidden-xs" href="">Hướng dẫn</a>
                </li>
                <li>
                    <a class="hidden-xs" href="">Liên hệ</a>
                </li>
                <li>
                    <a class="hidden-xs" href="">Điều khoản</a>                
                </li>
                <li class="dropdown visible-xs">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> 
                        Menu <i class="icon-options-vertical"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                        <li>
                            <a href="#" class="">
                                <p><i class="mdi mdi-home fa-fw"></i> <strong><?=__('Trang chủ')?></strong></p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="">
                                <p><i class="mdi mdi-book-open-page-variant fa-fw"></i> <strong><?=__('Hướng dẫn')?></strong></p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="">
                                <p><i class="mdi mdi-alert-octagram fa-fw"></i> <strong><?=__('Điều khoản')?></strong></p>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="">
                                <p><i class="mdi mdi-email-outline fa-fw"></i> <strong><?=__('Liên hệ')?></strong></p>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                        <input type="text" placeholder="<?=_('Tìm kiếm')?>..." class="form-control"> 
                        <a href=""><i class="fa fa-search"></i></a> 
                    </form>
                </li>

                <?php 
                    if (empty($this->Auth->user())) {
                        echo $this->cell('GuestMenu');
                    } else {
                        echo $this->cell('NotificationsMenu');
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