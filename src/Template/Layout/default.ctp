<!DOCTYPE html>
<html lang="<?= Cake\Core\Configure::read('System.iso-language') ?>">
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
    <?= $this->Html->css('/packages/AmpleAdmin/css/animate.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/style.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/colors/blue-dark.css', ['id' => 'theme']) ?>
    <?= $this->Html->css('style.css')?>
    <?= $this->fetch('css') ?>
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
        <?= $this->element('Layout/default/main-header') ?>
        <?= ($this->Auth->user()) ? $this->element('Layout/default/main-sidebar') :''?>
        <div id="page-wrapper" class="<?=($this->Auth->user())?'':'without-sidebar'?>">
            <div class="container-fluid">
                <?= $this->element('Layout/default/content-header') ?>
                <div style="margin-top:25px">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
            
            <?= $this->element('Layout/default/footer') ?>
        </div>
        <?= $this->Flash->render() ?>
    </div>

    <?= $this->Html->script('/packages/jquery/jquery-2.2.4.min.js') ?>
    <?= $this->Html->script('/packages/bootstrap/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/packages/sidebar-nav/dist/sidebar-nav.min.js') ?>
    <?= $this->Html->script('/packages/toast-master/js/jquery.toast.js') ?> 
    <?= $this->Html->script('/packages/AmpleAdmin/js/jquery.slimscroll.js') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/waves.js') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/mask.js') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/custom.min.js') ?>
    <?= $this->Html->script('/packages/styleswitcher/jQuery.style.switcher.js') ?>    
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js') ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/i18n/vi.js') ?>
    <?= $this->Html->script('app.settings.js') ?>
    <?= $this->fetch('script') ?>   
</body>
</html>