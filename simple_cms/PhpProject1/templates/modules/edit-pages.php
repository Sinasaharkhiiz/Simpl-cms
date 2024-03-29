<?php

function authentication_required() {
    return true;
}

function get_title() {
    return 'ویرایش برگه ها';
}

function get_content() { ?>

    <h3>برگه ها</h3>

    <table class="table table-bordered table-hover">
        <tr class="info">
            <th style="width: 60px;">ردیف</th>
            <th>عنوان</th>
            <th style="width: 240px;">عملیات</th>
        </tr>
        <?php
        $pages = get_all_pages(true);
        $counter = 0;
        foreach($pages as $page) {
            $counter++;
            $id = $page['id'];
            $title = $page['title'];
            $hidden = $page['hidden'];
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td>
                    <?php echo "<strong>$title</strong>"; ?>
                    <?php if($hidden): ?>
                        <span style="font-size: small;">[مخفی]</span>
                    <?php endif; ?>
                    <br>
                    <span style="color: #398439;">
                        <?php echo get_page_url($id); ?>
                    </span>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo get_page_edit_url($id); ?>">ویرایش</a>
                    <?php if($hidden): ?>
                        <a class="btn btn-sm btn-success" href="<?php echo get_page_unhide_url($id); ?>">ظاهر کردن</a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-warning" href="<?php echo get_page_hide_url($id); ?>">مخفی کردن</a>
                    <?php endif; ?>
                    <a class="btn btn-sm btn-danger" href="<?php echo get_page_delete_url($id); ?>">حذف</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    
    <br>
    <a class="btn btn-primary" href="<?php echo home_url('new'); ?>">صفحه جدید</a>
        
<?php }

function process_inputs() {
    
    if(empty($_GET)) {
       return; 
    }
    
    $action = strtolower($_GET['action']);
    $id = $_GET['id'];
    
    switch($action) {
        case 'hide':
            hide_page($id);
            break;
        
        case 'unhide':
            unhide_page($id);
            break;
        
        case 'delete':
            delete_page($id);
            break;
    }
    
    redirect_to(home_url('edit-pages'));
    
}


