<!DOCTYPE html>
<?php
    $hasSideBar = ($this->Auth->user() && ($this->request->prefix == "me") );
?>
<html lang="<?= $this->I18n->language() ?>">
<head>
    <title><?= Cake\Core\Configure::read('System.sitename') ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css') ?>
    <?= $this->Html->css('/packages/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/packages/sidebar-nav/dist/sidebar-nav.min.css') ?>
    <?= $this->Html->css('/packages/toast-master/css/jquery.toast.css') ?>
    <?= $this->Html->css('/packages/dropify/dist/css/dropify.min.css') ?>
    <?= $this->Html->css('/packages/sweetalert/sweetalert.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/animate.css') ?>
    <?= $this->fetch('css') //theme AmpleAdmin có chỉnh sửa lại các packages nên để tài nguyên packages lên trước?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/toilensong.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/colors/toilensong.css', ['id' => 'theme']) ?>
    <?= $this->AssetCompress->css('front'); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    
    <div id="wrapper">
        <?= $this->element('Layout/default/main-header',['hasSideBar' => $hasSideBar]) ?>
        <?= ($hasSideBar) ? $this->element('Layout/default/main-sidebar') :''?>
        <div id="page-wrapper" class="<?=($hasSideBar)?'':'without-sidebar'?> <?=($this->request->prefix == "front")?'wraper-bg-black':''?>">
            <div class="container-fluid">
                <?= $this->element('Layout/default/content-header') ?>
                <?= $this->Flash->render() ?>
                <div style="margin-top:25px">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
            <?= $this->element('Layout/default/footer') ?>
        </div>
    </div>
  
    <?= $this->AssetCompress->script('libs'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js') ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/i18n/vi.js') ?>
    <?= $this->fetch('script') ?>   
    <?= $this->AssetCompress->script('app'); ?>
</body>
</html>