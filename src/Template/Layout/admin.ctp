<!DOCTYPE html>
<html lang="<?= $this->I18n->language() ?>">
<head>
    <title><?= Cake\Core\Configure::read('System.sitename') ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <?= $this->Html->css('/packages/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/packages/sidebar-nav/dist/sidebar-nav.min.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/animate.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/style-admin.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/colors/megna-dark.css', ['id' => 'theme']) ?>
    <?= $this->AssetCompress->css('admin'); ?>
    <?= $this->fetch('css') ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="wrapper">
        <?= $this->element('Layout/admin/main-header') ?>
        <?= $this->element('Layout/admin/main-sidebar') ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $this->element('Layout/admin/content-header') ?>
                <?= $this->Flash->render() ?>
                <div style="margin-top:25px">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
            <?= $this->element('Layout/default/footer') ?>
        </div>
    </div>
    <?= $this->AssetCompress->script('libs'); ?>
</body>

</html>