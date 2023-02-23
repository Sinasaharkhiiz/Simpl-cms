<?php

function get_titile() {

    if ($current_user['username'] == 'admin') {
        return 'مدیریت سایت';
    } else {
        return 'محیط کاربری';
    }
}

function authentication_required() {
    return true;
}

function get_content() {
    ?>
    <p style="font-size: 25px"> 
        <?php
        $current_user = get_current_user_data();
        if ($current_user['username'] != 'admin') {

            echo 'سلام ' . $current_user['first_name'];
            ?>
            عزیز ، از این که ما را انتخاب کرده اید ممنونیم
        </p>
    <?php } ?>
    <?php if ($current_user['username'] == 'admin') { ?>
        <a class="btn btn-success" href="<?php echo home_url('edit-pages'); ?>">ویرایش صفحات</a>
         <a class="btn btn-success" href="<?php echo home_url('edit-users'); ?>">ویرایش اعضا</a>

    <?php } ?>


    <?php
}
