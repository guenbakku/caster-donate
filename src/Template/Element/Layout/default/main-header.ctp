    <nav class="navbar navbar-default navbar-static-top m-b-0 <?=($hasSideBar)?'':'without-sidebar'?>">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="/">
                    <?= $this->Html->image('logo.png', [
                            'class' => 'dark-logo', 
                            'alt' => __('home')
                        ]) ?>
                    <span class="hidden-xs my-red">
                        <span class="dark-logo"><?= \Cake\Core\Configure::read('System.sitename') ?></span>
                    </span> 
                </a>
            </div>
            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <?php if ($hasSideBar) {
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
                    <ul class="dropdown-menu dropdown-tasks animated bounceInDown">
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
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <div class="app-search hidden-sm hidden-xs m-r-10">
                        <?php $this->Form->setTemplates($FormTemplates['main-header-search']); ?>
                        <?= $this->cell('MultipleSelect', [
                            $this,
                            'tranport' => [
                                'read' => $this->Url->build('/api/v1/search/get-by-name'),
                                'jump' => true
                            ],
                            'input' => [
                                'name' => 'caster_tags',
                                'class' => 'form-control',
                                'label' => false,
                            ],
                            'select2Option' => [
                                'placeholder'=> __('Tìm kiếm'),
                                'language' => 'vi',
                                'minimumInputLength' => 1,
                            ],
                            'resultLayout' => [
                                'templateResult' => 'Select2MyResultFormat',
                            ],
                        ]) ?>
                        <a href=""><i class="fa fa-search"></i></a>
                    </div>
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