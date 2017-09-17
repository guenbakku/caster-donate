<!-- User Account Menu -->
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <?= $this->Html->image('user.jpg', ['class' => 'user-image', 'alt' => 'User Image']) ?>
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">Alexander Pierce</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <?= $this->Html->image('user.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            <p>
                Alexander Pierce - Web Developer
                <small>Member since Nov. 2012</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <?= $this->Html->link(
                    __d('CakeDC/Users', 'Logout'), 
                    '/logout',
                    ['class' => 'btn btn-default btn-flat']
                ) ?>
            </div>
        </li>
    </ul>
</li>