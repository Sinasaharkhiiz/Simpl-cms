<?php

function authentication_required() {
    return true;
}

function get_title() {
    return 'ویرایش اعضا';
}

function get_content() {
    ?>

    <h3>اعضا</h3>

    <table class="table table-bordered table-hover">
        <tr class="info">
            <th style="width: 60px;">ردیف</th>
            <th>نام</th>
            <th>نام کاربری</th>
            <th>رمز عبور</th>
            <th style="width: 240px">عملیات</th>
        </tr>
        <?php
        $users = get_all_users();
        $counter = 0;
        foreach ($users as $user) {
            $counter++;
            $id = $user['id'];
            $fname = $user['first_name'];
            $lname = $user['last_name'];
            $username = $user['username'];
            $passeord = $user['password'];
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td>
        <?php echo "<strong>$fname $lname</strong>"; ?>
                </td>
                  <td>
        <?php echo "$username"; ?>
                </td>
                  <td>
        <?php echo  ($passeord); ?>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo get_user_edit_url($id); ?>">ویرایش</a>
                    
                    <a class="btn btn-sm btn-danger" href="<?php echo get_user_delete_url($id); ?>">حذف</a>
                </td>
            </tr>
    <?php } ?>
    </table>

    

<?php
}

function process_inputs() {

    if (empty($_GET)) {
        return;
    }

    $action = strtolower($_GET['action']);
    $id = $_GET['id'];

    switch ($action) {
        case 'delete':
            delete_user($id);
            break;
    }

    redirect_to(home_url('edit-users'));
}
