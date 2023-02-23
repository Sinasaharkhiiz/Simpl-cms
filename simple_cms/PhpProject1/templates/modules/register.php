<?php
function get_title() {
    return 'ثبت نام';
}
function get_content() { ?>
    
    <?php get_module_name() ?>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ثبت نام</h3>
            </div>
            <div class="panel-body">
                
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="fname" class="col-sm-2 control-label">نام: </label>
                        <div class="col-sm-10">
                            <input class="form-control" id="fname" name="fname" placeholder="نام " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="col-sm-2 control-label" style="padding-right: 5px;">نام خانوادگی:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="lname" name="lname" placeholder="نام خانوادگی ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">نام کاربری:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="username" name="username" placeholder="نام کاربری">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">رمز عبور:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="password" name="password" placeholder="رمز عبور">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10" style="width: 90px;">
                            <button type="submit" name="register" class="btn btn-primary">ثبت نام</button>
                            
                            
                        </div>
                        <p style="   padding-top: 8px;"> قبلا ثبت نام کرده اید؟
                            <a href= <?php echo home_url('login'); ?>>ورود</a>
                            </p>
                    </div>
                </form>
                
            </div>
        </div>
        
        </div>
        <div class="col-md-3"></div>
    </div>
        
<?php }
function process_inputs() {
    
    if(!isset($_POST['register'])) {
        return;
    }
    if(isset($_POST['fname'])) {
        $fname = $_POST['fname'];
    }

    if(empty($fname)) {
        add_message('نام نمی تواند خالی باشد.', 'error');
        return;
    }
    if(isset($_POST['lname'])) {
        $lname = $_POST['lname'];
    }

    if(empty($lname)) {
        add_message('نام خانوادگی نمی تواند خالی باشد.', 'error');
        return;
    }
    
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if(user_exists($username)){
        add_message('کاربری با این نام کاربری از قبل ثبت نام کرده است', 'error');
        return;
    }

    if(empty($username)) {
        add_message('نام کاربری نمی تواند خالی باشد.', 'error');
        return;
    }
    
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    
    if(empty($password)) {
        add_message('رمز عبور نمی تواند خالی باشد.', 'error');
        return;
    }
    $userdata= array(
      'username'=>"$username",
      'password'=>"$password",
      'first_name'=>"$fname",
      'last_name' =>"$lname" 
    );
    add_user($userdata);
    add_message('ثبت نام با موفقیت انجام شد', 'success');
   
     
    
    
}