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
                <?=$this->Html->link(
                    __d('CakeDC/Users', 'Register'),
                    [
                        'plugin' => 'CakeDC/Users',
                        'prefix' => false,
                        'controller' => 'Users',
                        'action' => 'register',
                    ],
                    [
                        'class' => 'fcbtn btn-block btn btn-outline btn-success', 
                        'role' => 'button'
                    ]
                );?>
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
