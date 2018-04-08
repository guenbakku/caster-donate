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
    .page-background-bottom, .page-background-fixed, .page-background-top {
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
    .page-background-bottom {
        top: auto;
        bottom: 0;
    }
    img.cover{
        width: 100%;
        object-fit: cover;
    }

    .decorate-h{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    
    
    .decorate-h::after, .decorate-h::before{
        content: "";
        display: block;
        -webkit-box-flex: 100;
        -ms-flex: 100;
        flex: 100;
        border-bottom: 4px solid;
        -webkit-transform: translateY(-10px);
        -ms-transform: translateY(-10px);
        transform: translateY(-10px);
    }
    .decorate-h::before, .decorate-h::before {
        -webkit-box-flex: 20px;
        -ms-flex: 20px;
        flex: 20px;
        width: 20px;
        min-width: 20px;
    }
    .decorate-h::after, .decorate-h::before {
        border-bottom-color: #293139 !important;
    }
    .decorate-h span{
        padding: 0 10px;
    }
    #test{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        flex-wrap: wrap;
        /* tweak where items line
            up on the row
            valid values are: flex-start,
            flex-end, space-between,
            space-around, stretch */
        align-content: flex-end;
    }
</style>
<?php $this->end(); ?> 

<?php $this->append("script"); ?>
<script type="text/javascript">
    $(document).on('ready', function() {
      $(".slider").slick();
    });
</script>
<?php $this->end(); ?> 
<!--<?=$this->Html->image('demoHomePage/bg-top.png',['class' => 'page-background-top']);?>
<?=$this->Html->image('demoHomePage/bg-bottom.png',['class' => 'page-background-bottom']);?>-->

<div class="col-md-9">
    <div class="white-box bg-invisible" style="min-height:380px">
        <section class="slider" data-sizes="50vw">
            <div>
            <img class="cover" height=380 src="/img/demoHomePage/slide-1.jpg">
            </div>
            <div>
            <img class="cover" height=380 src="/img/demoHomePage/slide-2.jpg">
            </div>
            <div>
            <img class="cover" height=380 src="/img/demoHomePage/slide-3.jpg">
            </div>
            <div>
            <img class="cover" height=380 src="/img/demoHomePage/slide-4.jpg">
            </div>
        </section>
    </div>
    
    <div class="white-box bg-invisible">
        <h3 class="decorate-h"><span>HƯỚNG DẪN CHO<span class="my-red">STREAMER</span></span></h3>
        <section id="test">
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-5-mid.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ adsa asd sad asd asda sas dsadasdas asd ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-6-mid.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-7-mid.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-8-mid.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-3-sm.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
                <div class="col-md-4 m-b-20">
                    <img class="cover" style="height:150px" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-4-sm.jpg">
                    <h4>Hướng dẫn thủ tục đăng ký dịch vụ của TôiLênSóng</h4>
                    <p><span class="fa fa-calendar"></span> 08/04/2018</p>
                    <p>Thủ tục đơn giản, kích hoạt nhanh chóng. Bạn sẽ có thể bắt đầu sử dụng các tính năng của TôiLênSóng ngay lập tức. Chỉ cần có tài khoản ngân hàng, CMND, và điền đầy đủ ...</p>
                    <button class="btn btn-default my-white"><b>Đọc tiếp</b></button>
                </div>
        </section>
    </div>
</div>

<div class="col-md-3 m-t-50">
    <div class="white-box  bg-invisible">
        <h3 class="box-title decorate-h"><span><span class="my-red">Streamer</span> mới tham gia</span></h3>
        <p class="text-muted m-b-30">Chào mừng những streamer mới gia nhập cùng <span class="my-red">Tôi Lên Sóng</span></p>
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


