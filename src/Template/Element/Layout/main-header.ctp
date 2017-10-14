<header class="main-header">
    <!--<nav class="navbar navbar-static-top">-->
    <nav class="navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><strong><?= Cake\Core\Configure::read('System.sitename') ?></strong></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php 
                        if (empty($Auth->user())) {
                            echo $this->cell('GuestMenu');
                        } else {
                            echo $this->cell('NotificationsMenu');
                            echo $this->cell('MemberMenu', ['Auth' => $Auth]);
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>