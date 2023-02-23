<?php

function get_titile() {

    return 'ویرایش اطلاعات من';
}

function authentication_required() {
    return true;
}

function get_content() {
    ?>
    <?php $user = get_users($_GET['id']) ;
    if(!$user){
        echo 'لینک نادرست است!';
        return;
    }
            ?>
    <h3>ویرایش اطلاعات</h3>
    
    <br>
   

    <form class="form-horizontal" method="post">
        
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">نام کاربری</label>
            <div class="col-sm-10">

                <input class="form-control" id="username" name="username" placeholder="نام کاربری" value="<?php  echo $user['username']  ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="first_name" class="col-sm-2 control-label">نام</label>
            <div class="col-sm-10">

                <input class="form-control" id="first_name" name="first_name" placeholder="نام" value="<?php  echo $user['first_name']  ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="last_name" class="col-sm-2 control-label">نام خانوادگی</label>
            <div class="col-sm-10">

                <input class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی" value="<?php  echo $user['last_name']  ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">رمز عبور</label>
            <div class="col-sm-10">

                <input class="form-control" id="password" name="password" placeholder="رمز عبور" value="<?php  echo $user['password']  ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" >
                <button type="submit"  class="btn btn-primary">ذخیره</button>
            </div>
        </div>
    </form>
   
    <?php
}
function process_inputs() {
    
    if(empty($_POST)) {
        return;
    }
    
    $user = $_POST;
    $user['id'] = $_GET['id'];
    
    update_user($user);
}
