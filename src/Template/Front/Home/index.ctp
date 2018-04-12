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
    /* .decorate-h::before, .decorate-h::before {
        -webkit-box-flex: 20px;
        -ms-flex: 20px;
        flex: 20px;
        width: 20px;
        min-width: 20px;
    } */
    .decorate-h::after, .decorate-h::before {
        border-bottom-color: #293139 !important;
    }
    .decorate-h span{
        padding: 0 10px;
    }
    .flex-space-around{
        display: flex;
        align-items: center;
        justify-content: space-around;
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
<!-- <?=$this->Html->image('demoHomePage/bg-top.png',['class' => 'page-background-top']);?> -->
<?=$this->Html->image('demoHomePage/bg-bottom.png',['class' => 'page-background-bottom']);?>

<div class="col-md-12">
    <div class="banners demo-2 text-center m-t-40 m-b-40">
        <div class="fix-width">
            <div class="l-logo">
                <img width=100 src="/img/logo-lg.png">
            </div>
            <h1 class="m-t-0 p-b-10 my-red">Tôi Lên Sóng</h1>
            <p class="p-b-20">
                Công cụ hỗ trợ LiveStream một cách chuyên nghiệp
            </p>
            <div class="col-md-2 col-sm-2 col-md-offset-4 col-sm-offset-4">
                <button class="fcbtn btn-block btn btn-outline btn-success">Đăng ký</button>
            </div>
            <div class="col-md-2 col-sm-2">
                <button class="fcbtn btn btn-block btn-outline btn-danger">Hướng dẫn</button>
            </div>
        </div>
    </div>
</div>

<div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0 p-t-30">    
    <div class="white-box bg-invisible p-t-30">
        <h4 class="decorate-h p-b-20"><span class="my-red">Tính năng</span>của chúng tôi</h4>
        <section class="flex-space-around" style="text-align:center">
                <div class="col-md-3">
                    <img class="cover" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-5-mid.jpg">
                    <h4>Nhanh chóng</h4>
                    <p>Thủ tục đơn giản, kích hoạt ngay lập tức. </p>
                </div>
                <div class="col-md-3">
                    <img class="cover" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-6-mid.jpg">
                    <h4>Dễ dàng</h4>
                    <p>Giao diện thân thiện, có đầy đủ các bài viết hướng dẫn cách sử dụng website.</p>
                </div>
                <div class="col-md-3">
                    <img class="cover" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-7-mid.jpg">
                    <h4>Chuyên nghiệp</h4>
                    <p>Hỗ trợ các bảng thống kê thu nhập theo biểu đồ một cách trực quan, sinh động.</p>
                </div>
        </section>
    </div>
    <div class="white-box bg-invisible p-t-30">
        <h4 class="decorate-h p-b-20"><span>Hệ thống<span class="my-red">thanh toán</span></span></h4>
        <section class="flex-space-around" style="text-align:center">
                <div class="col-md-3">
                    <img class="cover" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-6-mid.jpg">
                    <h4>Đa dạng, phong phú</h4>
                    <p>Với nhiều phương thức từ thẻ điện thoại, Internet-Banking, Visa, MasterCard và nhiều ví điện tử khác ...</p>
                </div>
                <div class="col-md-3">
                    <img class="cover" src="https://cdn-html.nkdev.info/goodgames/assets/images/post-7-mid.jpg">
                    <h4>Nhận tiền dễ dàng</h4>
                    <p>Bạn không cần phải đăng ký gì thêm, thu nhập của bạn sẽ được tự động chuyển vào mỗi tháng.</p>
                </div>
        </section>
    </div>
</div>
