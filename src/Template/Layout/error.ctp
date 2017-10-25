<!DOCTYPE html>  
<html lang="<?= $this->I18n->language() ?>">
<head>
    <title><?= Cake\Core\Configure::read('System.sitename') ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->fetch('meta') ?>
    
    <?= $this->Html->css('/packages/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/animate.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/style.css') ?>
    <?= $this->Html->css('/packages/AmpleAdmin/css/colors/blue-dark.css', ['id' => 'theme']) ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <?= $this->fetch('content') ?>
            </div>
            <footer class="footer text-center">2017 © Ample Admin.</footer>
        </div>
    </section>
    <?= $this->Flash->render() ?>

    <?= $this->Html->script('/packages/jquery/jquery-2.2.4.min.js') ?>
    <?= $this->Html->script('/packages/bootstrap/js/bootstrap.min.js') ?>

</body>
</html>

