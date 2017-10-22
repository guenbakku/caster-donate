
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
</div>
<div class="col-md-9">
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
                                <div style="display:none">
                                    <input type="radio" id="radio1" name="mobile-card" value="1" checked/>
                                    <input type="radio" id="radio2" name="mobile-card" value="2" />
                                    <input type="radio" id="radio3" name="mobile-card" value="3" />
                                    <input type="radio" id="radio4" name="mobile-card" value="4" />
                                    <input type="radio" id="radio5" name="mobile-card" value="5" />
                                </div>
                                <div class="vtabs col-md-12 col-xs-12">
                                    <ul class="nav tabs-vertical">
                                        <li class="tab active">
                                            <a class="MY-tab-radio" data-for="radio1" data-toggle="tab" href="#tab-form-mobile-card" aria-expanded="true">
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
                                            <a class="MY-tab-radio" data-for="radio2" data-toggle="tab" href="#tab-form-mobile-card">
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
                                            <a class="MY-tab-radio" data-for="radio3" data-toggle="tab" href="#tab-form-mobile-card">
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
                                            <a class="MY-tab-radio" data-for="radio4" data-toggle="tab" href="#tab-form-mobile-card">
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
                                            <a class="MY-tab-radio" data-for="radio5" data-toggle="tab" href="#tab-form-mobile-card">
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
                        <h2>Tabbing 2</h2>
                    </section>
                    <section id="donate-the-tin-dung" class="">
                        <h2>Tabbing 3</h2>
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