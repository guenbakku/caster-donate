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
    <?= $this->Html->css('/packages/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/packages/sidebar-nav/dist/sidebar-nav.min.css') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/animate.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/style.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/colors/blue-dark.css',['id' => 'theme']) ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fix-header">
    <!--<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>-->

    <div id="wrapper">
        <?= $this->element('Layout/default/main-header') ?>
        <?php if ($this->Auth->user()) {
            echo $this->element('Layout/default/main-sidebar');
        }
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <?= $this->element('Layout/default/content-header') ?>
                </div>
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            
            <?= $this->element('Layout/default/footer') ?>
        </div>

        
    </div>


    
    <?= $this->Html->script('/packages/jquery/jquery-2.2.4.min.js') ?>
    <?= $this->Html->script('/packages/bootstrap/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/packages/sidebar-nav/dist/sidebar-nav.min.js') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/jquery.slimscroll.js') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/waves.js') ?>
    <?= $this->Html->script('/packages/styleswitcher/jQuery.style.switcher.js') ?>    
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('/packages/AmpleAdmin/js/custom.min.js') ?>
</body>
</html>