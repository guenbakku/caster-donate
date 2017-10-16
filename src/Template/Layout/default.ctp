<!DOCTYPE html>
<html lang="<?= $this->I18n->language() ?>">
<head>
    <title><?= Cake\Core\Configure::read('System.sitename') ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css') ?>
    <?= $this->Html->css('/packages/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/packages/iCheck/square/blue.css') ?>
    <?= $this->Html->css('/packages/KendoUI/styles/web/kendo.common.core.css') ?>
    <?= $this->Html->css('/packages/KendoUI/styles/web/kendo.silver.css') ?>
    <?= $this->Html->css('/packages/AdminLTE/css/AdminLTE.min.css') ?>
    <?= $this->Html->css('/packages/AdminLTE/css/skins/skin-red-light.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('css') ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red-light layout-top-nav">
    <div class="wrapper">
        <?= $this->element('Layout/default/main-header') ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <?= $this->element('Layout/default/content-header') ?>
                <section class="content">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </section>
            </div>
        </div>
        <?= $this->element('Layout/default/footer') ?>
    </div>
    <?= $this->Html->script('/packages/jquery/jquery-2.2.4.min.js') ?>
    <?= $this->Html->script('/packages/bootstrap/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/packages/slimScroll/jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('/packages/fastclick/fastclick.js') ?>
    <?= $this->Html->script('/packages/iCheck/icheck.min.js') ?>
    <?= $this->Html->script('/packages/AdminLTE/js/app.min.js') ?>
    <?= $this->Html->script('/packages/KendoUI/js/kendo.core.js') ?>
    <?= $this->Html->script('/packages/KendoUI/js/kendo.dateinput.js') ?>
    <?= $this->Html->script('/packages/KendoUI/js/cultures/kendo.culture.vi-VN.js') ?>
    <?= $this->Html->script('/packages/KendoUI/js/messages/kendo.messages.vi-VN.js') ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js') ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/i18n/vi.js') ?>
    <?= $this->Html->script('app.settings.js') ?>
    <?= $this->fetch('script') ?>
</body>
</html>