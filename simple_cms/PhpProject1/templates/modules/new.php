<?php

function authentication_required() {
    return true;
}

function get_title() {
    return 'ایجاد صفحه جدید';
}

function get_content() { ?>

    <h3>صفحه جدید</h3>
    <br>
    
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">عنوان</label>
            <div class="col-sm-10">
                <input class="form-control" id="title" name="title" placeholder="عنوان برگه" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="slug" class="col-sm-2 control-label">نامک</label>
            <div class="col-sm-10">
                <input class="form-control" id="slug" name="slug" placeholder="نامک برگه" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">محتوای برگه</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="20" id="content" name="content"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <label>
                    <input type="checkbox" id="hidden" name="hidden">
                    مخفی بودن برگه
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">ذخیره کردن</button>
            </div>
        </div>
    </form>
    
     <script src="https://cdn.tiny.cloud/1/1m8pqul3pakumja2mg8odqd13s46fmqvr9m61vivm8ar4v49/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </script>
    <script>tinymce.init({ 
        selector:'textarea#content',
        directionality: 'rtl'
    });</script>
    
<?php }

function process_inputs() {
    
    if(empty($_POST)) {
        return;
    }
    
    $page = $_POST;
    $page['id'] = null;
    
    if(isset($page['hidden']) && $page['hidden'] == 'on') {
        $page['hidden'] = 1;
    } else {
        $page['hidden'] = 0;
    }
    
    $id = add_page($page);
    
    redirect_to(get_page_edit_url($id));
}
