<?php
    echo $this->Html->css('/packages/slick-slider/css/slick.css', ['block' => 'css']);
    echo $this->Html->css('/packages/slick-slider/css/slick-theme.css', ['block' => 'css']);

    echo $this->Html->script('/packages/slick-slider/js/slick.js', ['block' => 'script']);
?>
<?php $this->append("css"); ?>
<style type="text/css">

    .slider {
        width: 100%;
        margin: 0px auto;
    }
</style>

<style type="text/css">
    #page-wrapper{
        background-color: #171e22 !important;
    }
    .nk-page-background-bottom, .nk-page-background-fixed, .nk-page-background-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: auto;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        z-index: 0;
    }
    .nk-page-background-bottom {
        top: auto;
        bottom: 0;
    }
    img {
        /* vertical-align: middle;
        border-style: none; */
    }

</style>
<?php $this->end(); ?> 

<?php $this->append("script"); ?>
<script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 3
      });
    });
</script>
<?php $this->end(); ?> 
<?=$this->Html->image('bg-top.png',['class' => 'nk-page-background-top']);?>
<?=$this->Html->image('bg-bottom.png',['class' => 'nk-page-background-bottom']);?>

<div class="col-md-9">
    <div class="white-box bg-invisible" style="min-height:380px">

        <!--<section class="center slider">
            <div>
            <img src="http://placehold.it/350x300?text=1">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=2">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=3">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=4">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=5">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=6">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=7">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=8">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=9">
            </div>
        </section>

        <section class="variable slider">
            <div>
            <img src="http://placehold.it/350x300?text=1">
            </div>
            <div>
            <img src="http://placehold.it/200x300?text=2">
            </div>
            <div>
            <img src="http://placehold.it/100x300?text=3">
            </div>
            <div>
            <img src="http://placehold.it/200x300?text=4">
            </div>
            <div>
            <img src="http://placehold.it/350x300?text=5">
            </div>
            <div>
            <img src="http://placehold.it/300x300?text=6">
            </div>
        </section>

        <section class="lazy slider" data-sizes="50vw">
            <div>
            <img data-lazy="http://placehold.it/350x300?text=1-350w" data-srcset="http://placehold.it/650x300?text=1-650w 650w, http://placehold.it/960x300?text=1-960w 960w" data-sizes="100vw">
            </div>
            <div>
            <img data-lazy="http://placehold.it/350x300?text=2-350w" data-srcset="http://placehold.it/650x300?text=2-650w 650w, http://placehold.it/960x300?text=2-960w 960w" data-sizes="100vw">
            </div>
            <div>
            <img data-lazy="http://placehold.it/350x300?text=3-350w"  data-srcset="http://placehold.it/650x300?text=3-650w 650w, http://placehold.it/960x300?text=3-960w 960w" data-sizes="100vw">
            </div>
            <div>
            <img data-lazy="http://placehold.it/350x300?text=4-350w"  data-srcset="http://placehold.it/650x300?text=4-650w 650w, http://placehold.it/960x300?text=4-960w 960w" data-sizes="100vw">
            </div>
            <div>
            <img data-lazy="http://placehold.it/350x300?text=5-350w"  data-srcset="http://placehold.it/650x300?text=5-650w 650w, http://placehold.it/960x300?text=5-960w 960w" data-sizes="100vw">
            </div>
            <div>
            <img data-lazy="http://placehold.it/350x300?text=6-350w"  data-srcset="http://placehold.it/650x300?text=6-650w 650w, http://placehold.it/960x300?text=6-960w 960w">
            </div>
        </section>-->
    </div>
    
    <div class="white-box bg-invisible">
        <h3 class="nk-decorated-h-2 my-red"><span>Bài Viết Hướng dẫn</span></h3>
        <section class="regular slider">
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-5-mid.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-6-mid.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-7-mid.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-8-mid.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-3-sm.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-4-sm.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
            <div class="col-md-4">
                <img style="width: 100%;height:150px;object-fit: cover;" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-1-sm.jpg">
                <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                <p class="my-red"><span class="fa fa-calendar"></span> 08/04/2018</p>
                <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
            </div>
        </section>
    </div>
</div>

<div class="col-md-3">
    <div class="white-box">
        <h3 class="box-title">Streamer mới tham gia</h3>
        <p class="text-muted m-b-30">Chào mừng những streamer mới gia nhập cùng<code>Tôi Lên Sóng</code></p>
        <!-- Nav tabs -->
        <ul class="nav customtab nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Dota</span></a></li>
            <li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">LOL</span></a></li>
            <li role="presentation" class=""><a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">PUPG</span></a></li>
            <li role="presentation" class=""><a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">More</span></a></li>
        </ul>
        
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="home1">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <a href="contact-detail.html"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3 class="box-title m-b-0">Mimosa</h3> 
                            <small>[Giới thiệu bản thân]</small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <a href="contact-detail.html"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3 class="box-title m-b-0">Mimosa</h3> 
                            <small>[Giới thiệu bản thân]</small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <a href="contact-detail.html"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3 class="box-title m-b-0">Mimosa</h3> 
                            <small>[Giới thiệu bản thân]</small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <a href="contact-detail.html"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3 class="box-title m-b-0">Mimosa</h3> 
                            <small>[Giới thiệu bản thân]</small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center">
                            <a href="contact-detail.html"><img src="/img/default_avatar.jpg" alt="user" class="img-circle img-responsive"></a>
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3 class="box-title m-b-0">Mimosa</h3> 
                            <small>[Giới thiệu bản thân]</small>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile1">
                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="messages1">
                
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings1">
                
            </div>
        </div>
    </div>
</div>


