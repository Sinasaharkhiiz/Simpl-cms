<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if(is_user_loggen_in()): ?>
                <li>
                    <p class="navbar-text">
                    
                    <?php $current_user = get_current_user_data(); ?>
                        <strong style="font-size: 14px"><?php echo $current_user['first_name'] .' '. $current_user['last_name']; ?></strong>
                    </p>
                </li>
                <?php endif; ?>
                
                <li><a href="<?php echo home_url(); ?>">صفحه اصلی</a></li>
                
                <?php if(is_user_loggen_in()){ ?>
                <li><a href="<?php echo home_url('dashboard'); ?>">صفحه کاربری</a></li>
                 <?php if ($current_user['username'] == 'admin') { ?>
                <li><a href="<?php echo home_url('new'); ?>">صفحه جدید</a></li>
                 <?php } ?>
                <?php } ?>
                <?php display_pages_list(false); ?>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                
                <li>
                    <?php if(is_user_loggen_in()): ?>
                        <a href="<?php echo home_url('logout'); ?>">خروج</a>
                    <?php endif; ?>
                </li>
                 <?php if(!is_user_loggen_in()): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ورود/ثبت نام <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo home_url('login'); ?>">ورود</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo home_url('register'); ?>">ثبت نام</a></li>
                      
                    </ul>
                </li>
                 <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>