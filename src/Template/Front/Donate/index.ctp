<?php
require_once(APP . 'Libs' . DS . 'NganLuong' . DS . 'config.php');	
require_once(APP . 'Libs' . DS . 'NganLuong' . DS . 'include' . DS . 'lib' . DS . 'nusoap.php');	
require_once(APP . 'Libs' . DS . 'NganLuong' . DS . 'include' . DS . 'nganluong.microcheckout.class.php');
$inputs = array(
    'receiver'		=> RECEIVER,
    'order_code'	=> 'DH-'.date('His-dmY'),
    'return_url'	=> 'controler xử lý kết quả trả về'.'/payment_success.php',
    'cancel_url'	=> '',
    'language'		=> 'vn'
);
$link_checkout = '';
$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
$result = $obj->setExpressCheckoutDeposit($inputs);
if ($result != false) {
    if ($result['result_code'] == '00') {
        $link_checkout = $result['link_checkout'];
        $link_checkout = str_replace('micro_checkout.php?token=', 'index.php?portal=checkout&page=micro_checkout&token_code=', $link_checkout);
        $link_checkout .='&payment_option=nganluong';
    } else {
        die('Ma loi '.$result['result_code'].' ('.$result['result_description'].') ');
    }
} else {
    die('Loi ket noi toi cong thanh toan ngan luong');
}

?>




<div class="row">
    <div class="col-md-3">
        <div class="white-box">
            <?=$this->Html->image($caster_profile->avatar_url,[
                'class' => 'img-circle col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12',
                'alt' => h($caster_profile->nickname)
            ])?>
            <div class="user-btm-box">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th colspan="2" class="text-center">
                                <h4><?=__('Thông tin Caster')?></h4>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tên</td>
                                <td><strong><?=h($caster_profile->nickname)?></strong></td>
                            </tr>
                            <?php
                            if(isset($caster_profile->social_providers))
                            {
                                foreach($caster_profile->social_providers as $social_provider)
                                {?>                        
                                <tr style="border-top:none">
                                    <td><?=$social_provider->name?></td>
                                    <td><?=($social_provider->_joinData->public) ? h($social_provider->_joinData->reference) : ''?></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td>Lời giới thiệu</td>
                                <td><?=h($caster_profile->introduction)?></td>
                            </tr>
                            <tr>
                                <td>Tag Lên Sóng</td>
                                <td></td>
                            </tr>
                            <?php
                            if($this->Auth->user())
                            {?>
                            <tr>
                                <td colspan="2"><button class="btn btn-block btn-info"><?=__('Theo dõi')?></button></td>
                            </tr>
                            <?php
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?php
        if(!$this->Auth->user())
        {?>
        <div class="white-box">
            <h3 class="box-title"><?=__('Đăng nhập')?></h3>
            <hr class="m-t-0 m-b-40">
            <p class="text-muted"><?=__('Đăng nhập để Caster biết đến bạn là ai và để có thể sử dụng nhiều tính năng hấp dẫn khác.')?></p>
            <button class="btn btn-facebook waves-effect waves-light" type="button"> <i class="fa fa-facebook"></i> Tài khoản Facebook</button>
            <button class="btn btn-googleplus waves-effect waves-light" type="button"> <i class="fa fa-google-plus"></i> Tài khoản Google</button>
            <button class="btn btn-primary waves-effect waves-light" type="button"> Tài khoản ToiLenSong</button>
        </div>
        <?php 
        }?>
        <div class="white-box">
            <h3 class="box-title"><?=__('Tài Trợ')?></h3>
            <hr class="m-t-0 m-b-40">
            <section class="m-t-40">
                <div class="col-lg-3 col-sm-3 col-xs-12">
                    <button class="btn btn-block btn-info"><i class="sticon mdi mdi-bank"></i><span><?=__('Thông qua ngân hàng')?></span></button>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-12">
                    <button class="btn btn-block btn-info"><i class="sticon mdi mdi-credit-card"></i><span><?=__('Thẻ tín dụng')?></span></button>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-12">
                    <button class="btn btn-block btn-info"><i class="sticon mdi mdi-cards"></i><span><?=__('Thẻ điện thoại')?>(Bảo trì)</span></button>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-12">
                    <button class="btn btn-block btn-info"><i class="sticon mdi mdi-coin"></i><span><?=__('Vỏ Sò')?> (todo:cần đăng nhập)</span></button>
                </div>
                <div class="clearfix"></div>


                <!--<div class="sttabs tabs-style-iconbox">
                    <nav>
                        <ul>
                            <li class=""><a href="#donate-the-ngan-hang" class="sticon mdi mdi-bank"><span><?=__('Thông qua ngân hàng')?></span></a></li>
                            <li class=""><a href="#donate-the-tin-dung" class="sticon mdi mdi-credit-card"><span><?=__('Thẻ tín dụng')?></span></a></li>
                            <li class=""><a class="sticon mdi mdi-cards"><span><?=__('Thẻ điện thoại')?></span></a></li>
                            <li class=""><a href="#donate-vo-so" class="sticon mdi mdi-coin"><span><?=__('Vỏ Sò')?></span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap m-l-0">
                        
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
                                            <div class="col-md-12">
                                                <button class="btn btn-success miw-100">Thanh toán</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>

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
                                                <label class="col-md-12">Tên của bạn </label>
                                                <div class="col-md-12">
                                                    <?php
                                                    if($this->Auth->user())
                                                    {
                                                        echo '<input type="text" class="form-control form-control-line" value="'.$this->Auth->user('username').'" readonly>';
                                                    }
                                                    else
                                                    {
                                                        echo '<input type="text" class="form-control form-control-line">';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Thông điệp </label>
                                                <div class="col-md-12">
                                                    <textarea type="text" class="form-control form-control-line" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button class="btn btn-success miw-100">Nạp thẻ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </section>

                        <section id="donate-vo-so" class="">
                            <?php
                            if($this->Auth->user())
                            {?>
                            <div class="white-box col-md-4">
                                Số sò hiện có trong tài khoản: ______ sò<br>
                                Số sò hiện có của caster:<?=$caster_profile->balance?> sò
                            </div>
                            <div class="col-md-8">
                                <?=$this->Form->create(null, [
                                    'type' => 'put',
                                    //'url' => ['prefix'=>null,'controller'=>'donate','action'=>'perform',h($caster_profile->user_id)],
                                    'class' => 'form-material form-horizontal',
                                ]);?>
                                <?= $this->Form->control('donate_method_selector', [
                                    'type'  => 'hidden',
                                    'label' => false,
                                    'value' => 'coin'
                                ]) ?>
                                <?= $this->Form->control('receiver_id', [
                                    'type'  => 'hidden',
                                    'label' => false,
                                    'value' => $caster_profile->user_id
                                ]) ?>
                                <?= $this->Form->control('sender_id', [
                                    'type'  => 'hidden',
                                    'label' => false,
                                    'value' => ($this->Auth->user('id')) ?: null
                                ]) ?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <?= $this->Form->control('amount', [
                                            'class' => 'form-control',
                                            'type'  => 'text',
                                            'label' => 'Nhập số sò muốn donate',
                                            'value' => ''
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <?= $this->Form->control('receiver_name', [
                                            'class' => 'form-control form-control-line',
                                            'type'  => 'text',
                                            'label' => 'Tên của bạn',
                                            'value' => $this->Auth->user('username') ?: '',
                                            'disabled' => ($this->Auth->user() ? 'disabled' : '')
                                        ]);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Thông điệp </label>
                                    <div class="col-md-12">
                                        <textarea type="text" class="form-control form-control-line" rows="4"></textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success miw-100" value="Donate"/>
                                <?= $this->Form->end() ?>
                            </div>
                            <?php
                            }
                            else
                            {?>
                                <h4><?=__('Bạn cần đăng nhập để sử dụng tính năng này.')?></h4>    
                            <?php
                            }?>
                        </section>
                    </div>
                </div>-->
                <!-- /tabs -->
            </section>
        </div>
        <div class="white-box">
            <h3 class="box-title"><?=__('Test Nạp tiền')?></h3>
            <hr class="m-t-0 m-b-40">
            <section class="m-t-40">
                <?=$this->Form->create(null, [
                    'type' => 'put',
                    'url' => ['prefix'=>null,'controller'=>'donate','action'=>'direct-donate',h($caster_profile->user_id)],
                ]);?>
                    <?php
                    if(!$this->Auth->user())
                    {
                        echo $this->Form->input('donater', [
                                'type'  => 'text',
                                'label' => 'Tên của bạn',
                            ]);
                    }
                    echo $this->Form->input('amount', [
                        'type'  => 'text',
                        'label' => 'Số tiền',
                    ]);
                    echo $this->Form->input('message', [
                        'type'  => 'text',
                        'label' => 'Thông điệp',
                    ]);
                    ?>
                    <input type="submit" value="Tài trợ">
                <?= $this->Form->end() ?>
            </section>
            <input class="button" type="button" id="btn_deposit" value="Nạp tiền" />
        </div>
    </div>
</div>




                            
                                








<style type="text/css">
    .bg-none{
        background-color: #ffffff00 !important;
    }
</style>

<script language="javascript">
if(typeof NGANLUONG=="undefined"||!NGANLUONG){var NGANLUONG={};}NGANLUONG.apps=NGANLUONG.apps||{};(function(){var ll1={trigger:null,url:null};NGANLUONG.apps.MCFlow=function(lll){var jj=this;jj.UI={};jj._lj(lll);jj.setTrigger=function(ll){jj._l1(ll);};jj.startFlow=function(url){var il=jj._li();if(il.location){il.location=url;}else{il.src=url;}};jj.closeFlow=function(){jj._i();};jj.isOpen=function(){return jj.isOpen;};};
NGANLUONG.apps.MCFlow.prototype={name:"PPDGFrame",isOpen:false,
_lj:function(lll){if(lll){for(var key in ll1){if(typeof lll[key]!=="undefined"){this[key]=lll[key];}else{this[key]=ll1[key];}}}if(this.trigger){this._l1(this.trigger);}this._ij();},_li:function(){this._ii();this._j();this._ll();this._il();this.isOpen=true;return this.UI.ll;},_ii:function(){this.UI.l1=document.createElement("div");this.UI.l1.id=this.name;this.UI.li=document.createElement("div");this.UI.li.className="panel bg-none";this.UI.close=document.createElement("div");this.UI.close.className="close";try{this.UI.ll=document.createElement("<iframe name=\""+this.name+"\">");}catch(e){this.UI.ll=document.createElement("iframe");this.UI.ll.name=this.name;}this.UI.ll.frameBorder=0;this.UI.ll.border=0;this.UI.ll.scrolling="no";this.UI.ll.allowTransparency="true";this.UI.i1=document.createElement("div");this.UI.i1.className="mask";this.UI.li.appendChild(this.UI.close);this.UI.li.appendChild(this.UI.ll);this.UI.l1.appendChild(this.UI.i1);this.UI.l1.appendChild(this.UI.li);document.body.appendChild(this.UI.l1);},_j:function(){var windowWidth,windowHeight,scrollWidth,scrollHeight,width,height;if(window.innerHeight&&window.scrollMaxY){scrollWidth=window.innerWidth+window.scrollMaxX;scrollHeight=window.innerHeight+window.scrollMaxY;}else if(document.body.scrollHeight>document.body.offsetHeight){scrollWidth=document.body.scrollWidth;scrollHeight=document.body.scrollHeight;}else{scrollWidth=document.body.offsetWidth;scrollHeight=document.body.offsetHeight;}if(window.innerHeight){windowWidth=window.innerWidth;windowHeight=window.innerHeight;}else if(document.documentElement&&document.documentElement.clientHeight){windowWidth=document.documentElement.clientWidth;windowHeight=document.documentElement.clientHeight;}else if(document.body){windowWidth=document.body.clientWidth;windowHeight=document.body.clientHeight;}width=windowWidth>scrollWidth?windowWidth:scrollWidth;height=windowHeight>scrollHeight?windowHeight:scrollHeight;this.UI.i1.style.width=width+"px";this.UI.i1.style.height=height+"px";},_ll:function(e){var width,height,scrollY;if(window.innerWidth){width=window.innerWidth;height=window.innerHeight;scrollY=window.pageYOffset;}else if(document.documentElement&&(document.documentElement.clientWidth||document.documentElement.clientHeight)){width=document.documentElement.clientWidth;height=document.documentElement.clientHeight;scrollY=document.documentElement.scrollTop;}else if(document.body&&(document.body.clientWidth||document.body.clientHeight)){width=document.body.clientWidth;height=document.body.clientHeight;scrollY=document.body.scrollTop;}this.UI.li.style.left=Math.round((width-this.UI.ll.offsetWidth)/2)+"px";var ij=Math.round((height-this.UI.ll.offsetHeight)/2)+scrollY;if(ij<5){ij=10;}this.UI.li.style.top=ij+"px";},_il:function(){il(this.UI.close,"click",this._i,this);il(window,"resize",this._j,this);il(window,"resize",this._ll,this);il(window,"unload",this._i,this);},_l1:function(ll){ll=document.getElementById(ll);if(ll&&ll.form){ll.form.target=this.name;}else if(ll&&ll.tagName.toLowerCase()=="a"){ll.target=this.name;}il(ll,"click",this._i1,this);},_i1:function(e){var il=this._li();if(this.url!=null){if(il.location){il.location=this.url;}else{il.src=this.url;}}}
,_i:function(e){if(this.isOpen&&this.UI.l1.parentNode){this.UI.l1.parentNode.removeChild(this.UI.l1);}jl(window,"resize",this._j);jl(window,"resize",this._ll);jl(window,"unload",this._i);this.isOpen=false;}
,_ij:function(){var css="",
lj=document.createElement("style");
css+="#"+this.name+" { z-index:20002; position:absolute; top:0; left:0; }";
css+="#"+this.name+" .panel { z-index:20003; position:relative; }";
css+="#"+this.name+" .panel iframe { width:516px; height:700px; border:0; }";
css+="#"+this.name+" .panel .close { width:26px; height:26px; border:0; display:block; position:absolute; margin-left:486px; cursor:pointer; }";
css+="#"+this.name+" .mask { z-index:20001; position:absolute; top:0; left:0; background-color:#000; opacity:0.6; filter:alpha(opacity=60); }";
lj.type="text/css";
if(lj.styleSheet){lj.styleSheet.cssText=css;}
else{lj.appendChild(document.createTextNode(css));}

document.getElementsByTagName("head")[0].appendChild(lj);}};

var ii=[];function il(j,type,fn,scope){scope=scope||j;var li;if(j.addEventListener){li=function(e){fn.call(scope,e);};j.addEventListener(type,li,false);}else if(j.attachEvent){li=function(){var e=window.event;e.target=e.target||e.srcElement;e.llj=function(){window.event.returnValue=false;};fn.call(scope,e);};j.attachEvent("on"+type,li);}ii.push([j,type,fn,li]);}function jl(j,type,fn){var li,item,len,i;for(i=0;i<ii.length;i++){item=ii[i];if(item[0]==j&&item[1]==type&&item[2]==fn){li=item[3];if(li){if(j.j1){j.j1(type,li,false);}else if(j.lli){j.lli("on"+type,li);}}}}}function ji(ij){do{ij=ij.parentNode;}while(ij&&ij.nodeType!=1);return ij;}})();
</script>
<script language="javascript">
	var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'btn_deposit',url:'<?php echo @$link_checkout;?>'});
</script>