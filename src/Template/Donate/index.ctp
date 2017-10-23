
<div class="col-md-3">
    <div class="white-box">
        <div class="col-md-12 text-center">
        <?=$this->Html->image($profile->avatar_url,[
            'class' => '',
            'alt' => h($profile->nickname)
        ])?>
        </div>
        <div class="user-btm-box">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th colspan="2" class="text-center">
                            <h5><?=__('Thông tin Caster')?></h5>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tên</td>
                            <td><strong><?=h($profile->nickname)?></strong></td>
                        </tr>
                        <?php
                        foreach($profile->social_providers as $social_provider){?>                        
                        <tr style="border-top:none">
                            <td><?=$social_provider->name?></td>
                            <td><?=h($social_provider->_joinData->reference)?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td>Lời giới thiệu</td>
                            <td><?=h($profile->introduction)?></td>
                        </tr>
                        <tr>
                            <td>Tag Lên Sóng</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button class="btn btn-block btn-info"><?=__('Theo dõi')?></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="white-box">
        <h3>Form test donate</h3>
        <form class="form-material form-horizontal" method="" action="">
             <div class="form-group">
                <label class="col-md-12">Số tiền </label>
                <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" name="amount"> 
                </div>
            </div>
            <input type="submit" class="btn btn-primary waves-effect waves-light" value="Donate"/>
        </form>
    </div>
</div>
<div class="col-md-9">
    <?php
    //if(!$this->Auth->user())
    //{?>
    <div class="white-box">
        <h3 class="box-title"><?=__('Đăng nhập')?></h3>
        <p class="text-muted"><?=__('Đăng nhập để Caster biết đến bạn là ai và để có thể sử dụng nhiều tính năng hấp dẫn khác.')?></p>
        <button class="btn btn-facebook waves-effect waves-light" type="button"> <i class="fa fa-facebook"></i> Tài khoản Facebook</button>
        <button class="btn btn-googleplus waves-effect waves-light" type="button"> <i class="fa fa-google-plus"></i> Tài khoản Google</button>
        <button class="btn btn-primary waves-effect waves-light" type="button"> Tài khoản ToiLenSong </button>
    </div>
    <?php 
    //}?>
    <div class="white-box">
        <h3 class="box-title"><?=__('Lựa chọn phương thức thanh toán')?></h3>
        <section class="m-t-40">
            <div class="sttabs tabs-style-iconbox">
                <nav>
                    <ul>
                        <li class=""><a href="#donate-the-dien-thoai" class=" sticon mdi mdi-cards"><span><?=__('Thẻ điện thoại')?></span></a></li>
                        <li class=""><a href="#donate-the-ngan-hang" class="sticon mdi mdi-bank"><span><?=__('Thông qua ngân hàng')?></span></a></li>
                        <li class=""><a href="#donate-the-tin-dung" class="sticon mdi mdi-credit-card"><span><?=__('Thẻ tín dụng')?></span></a></li>
                    </ul>
                </nav>
                <div class="content-wrap">
                    <section id="donate-the-dien-thoai" class="">
                            <form action="" method="" class="form-material form-horizontal">
                                <div style="display:none__">
                                    <input type="radio" id="radio-mobile-1" name="mobile-card" value="1" checked/>
                                    <input type="radio" id="radio-mobile-2" name="mobile-card" value="2" />
                                    <input type="radio" id="radio-mobile-3" name="mobile-card" value="3" />
                                    <input type="radio" id="radio-mobile-4" name="mobile-card" value="4" />
                                    <input type="radio" id="radio-mobile-5" name="mobile-card" value="5" />
                                </div>
                                <div class="vtabs col-md-12 col-xs-12">
                                    <ul class="nav tabs-vertical">
                                        <li class="tab active">
                                            <a class="MY-tab-radio" data-for="radio-mobile-1" data-toggle="tab" href="#tab-form-mobile-card" aria-expanded="true">
                                                <span>
                                                    <?= $this->Html->image('mobile/viettel.png', [
                                                        'class' => '', 
                                                        'height' => '15px',
                                                        'alt' => __('Viettel'),
                                                    ]) ?>
                                                </span> 
                                                <span class="hidden-xs pull-right">Viettel</span>
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="MY-tab-radio" data-for="radio-mobile-2" data-toggle="tab" href="#tab-form-mobile-card">
                                                <span>
                                                    <?= $this->Html->image('mobile/mobifone.png', [
                                                        'class' => '', 
                                                        'height' => '15px',
                                                        'alt' => __('Mobifone'),
                                                    ]) ?>
                                                </span> 
                                                <span class="hidden-xs pull-right">Mobifone</span>
                                            </a>
                                        </li> 
                                        <li class="tab">
                                            <a class="MY-tab-radio" data-for="radio-mobile-3" data-toggle="tab" href="#tab-form-mobile-card">
                                                <span>
                                                    <?= $this->Html->image('mobile/vinaphone.png', [
                                                        'class' => '', 
                                                        'height' => '15px',
                                                        'alt' => __('Vinaphone'),
                                                    ]) ?>
                                                </span> 
                                                <span class="hidden-xs pull-right">Vinaphone</span>
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="MY-tab-radio" data-for="radio-mobile-4" data-toggle="tab" href="#tab-form-mobile-card">
                                                <span>
                                                    <?= $this->Html->image('mobile/gate.png', [
                                                        'class' => '', 
                                                        'height' => '15px',
                                                        'alt' => __('Gate'),
                                                    ]) ?>
                                                </span> 
                                                <span class="hidden-xs pull-right">Gate</span>
                                            </a>
                                        </li>
                                        <li class="tab">
                                            <a class="MY-tab-radio" data-for="radio-mobile-5" data-toggle="tab" href="#tab-form-mobile-card">
                                                <span>
                                                    <?= $this->Html->image('mobile/vtc.png', [
                                                        'class' => '', 
                                                        'height' => '15px',
                                                        'alt' => __('Vtc'),
                                                    ]) ?>
                                                </span> 
                                                <span class="hidden-xs pull-right">Vtc</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="form-group">
                                            <label class="col-md-12">Số seri thẻ </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control form-control-line"> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Mã số nạp tiền </label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control form-control-line"> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3 pull-right">
                                                <button class="btn btn-block btn-success">Nạp thẻ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </section>





                    <section id="donate-the-ngan-hang" class="">
                        <form action="" method="" class="form-material form-horizontal">
                            <div style="display:none__">
                                <input type="radio" id="radio-bank-1" name="credit-card" value="1" checked/>
                                <input type="radio" id="radio-bank-2" name="credit-card" value="2" />
                            </div>
                            <div class="vtabs col-md-12 col-xs-12">
                                <ul class="nav tabs-vertical">
                                    <li class="tab active">
                                        <a class="MY-tab-radio" data-for="radio-bank-1" data-toggle="tab" href="#bank-atm" aria-expanded="true">
                                            <span class="">Thẻ ATM</span>
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a class="MY-tab-radio" data-for="radio-bank-2" data-toggle="tab" href="#bank-internet-banking">
                                            <span class="">Internet Banking</span>
                                        </a>
                                    </li> 
                                </ul>
                                <div class="tab-content">
                                    <div id="bank-atm" class="tab-pane active">
                                        Chưa biết (1)
                                    </div>
                                    <div id="bank-internet-banking" class="tab-pane">
                                        Chưa biết (2)
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>





                    <section id="donate-the-tin-dung" class="">
                        <form action="" method="" class="form-material form-horizontal">
                            <div style="display:none__">
                                <input type="radio" id="radio-credit-1" name="credit-card" value="1" checked/>
                                <input type="radio" id="radio-credit-2" name="credit-card" value="2" />
                                <input type="radio" id="radio-credit-3" name="credit-card" value="3" />
                            </div>
                            <div class="vtabs col-md-12 col-xs-12">
                                <ul class="nav tabs-vertical">
                                    <li class="tab active">
                                        <a class="MY-tab-radio" data-for="radio-credit-1" data-toggle="tab" href="#tab-form-mobile-card" aria-expanded="true">
                                            <span>
                                                <?= $this->Html->image('credit/visacard.png', [
                                                    'class' => '', 
                                                    'height' => '15px',
                                                    'alt' => __('Visa Card'),
                                                ]) ?>
                                            </span> 
                                            <span class="hidden-xs pull-right">Visa</span>
                                        </a>
                                    </li>
                                    <li class="tab">
                                        <a class="MY-tab-radio" data-for="radio-credit-2" data-toggle="tab" href="#tab-form-mobile-card">
                                            <span>
                                                <?= $this->Html->image('credit/mastercard.png', [
                                                    'class' => '', 
                                                    'height' => '15px',
                                                    'alt' => __('Master Card'),
                                                ]) ?>
                                            </span> 
                                            <span class="hidden-xs pull-right">Master</span>
                                        </a>
                                    </li> 
                                    <li class="tab">
                                        <a class="MY-tab-radio" data-for="radio-credit-3" data-toggle="tab" href="#tab-form-mobile-card">
                                            <span>
                                                <?= $this->Html->image('credit/JCB.png', [
                                                    'class' => '', 
                                                    'height' => '15px',
                                                    'alt' => __('JCB Card'),
                                                ]) ?>
                                            </span> 
                                            <span class="hidden-xs pull-right">JCB</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="form-group">
                                        <label class="col-md-12">Số thẻ</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Tên chủ thẻ</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ngày hết hạn</label>
                                        <div class="col-md-12">
                                            <input type="text" data-mask="99/99" class="form-control form-control-line"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Mã CVV/CVC2</label>
                                        <div class="col-md-12">
                                            <input type="text" data-mask="999" class="form-control form-control-line"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Số tiền nạp</label>
                                        <div class="col-md-12">
                                            <input type="text" data-mask="999.999.000 đồng" class="form-control form-control-line"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 pull-right">
                                            <button class="btn btn-block btn-success">Thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- /content -->
            </div>
            <!-- /tabs -->
        </section>
    </div>
</div>




                            
                                









<?php 
echo $this->Html->script('/packages/AmpleAdmin/js/jasny-bootstrap.js');
echo $this->Html->script('/packages/AmpleAdmin/js/cbpFWTabs.js');
?>