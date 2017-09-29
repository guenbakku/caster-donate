<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <?= $this->Html->image($profile['avatar'], [
                    'class' => 'profile-user-img img-responsive img-circle', 
                    'alt' => __d('CakeDC/Users', 'User profile picture')
                ]) ?>
                <h3 class="profile-username text-center"><?=($profile['nickname'] != null)?$profile['nickname']:(__('Chưa thiết lập nickname'))?></h3>
                <p class="text-muted text-center"><?=__('Ngày tham gia')?> : <?=$this->Time->format($profile['created'], 'd-m-Y');?></p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?=__('Ngày sinh')?></b> <a class="pull-right"><?=$profile['birthday']?></a>
                    </li>
                    <li class="list-group-item">
                        <b><?=__('Nơi ở hiện tại')?></b> <a class="pull-right">Đà Nẵng - Việt Nam</a>
                    </li>
                    <li class="list-group-item">
                        <b>Facebook</b> <a class="pull-right"><?=($profile['facebook_public'] == true) ? $profile['facebook'] : ''?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Zalo</b> <a class="pull-right"><?=($profile['zalo_public'] == true) ? $profile['zalo'] : ''?></a>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"><b><?=__('Theo dõi')?></b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?=__('Về tôi')?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> <?=__('Lời giới thiệu')?></strong>
                <p class="text-muted">
                    <?=$profile['introduction']?>
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> <?=__('Tag Live Stream')?></strong>
                <p>
                    <span class="label label-danger">Dota 2</span>
                    <span class="label label-success">Lol</span>
                    <span class="label label-info">Học tiếng Nhật</span>
                </p>
                <hr>
                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="false"><?=__('Lịch Live Stream')?></a></li>
                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false"><?=__('Cập nhật thông tin')?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                            10 Feb. 2014
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Read more</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-green">
                            3 Jan. 2014
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-camera bg-purple"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                <div class="timeline-body">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="settings">
                    <?= $this->element('Me/form-profile') ?>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
<!-- /.col -->
</div>
<!-- /.row -->