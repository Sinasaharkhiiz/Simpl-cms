<?php

function get_all_pages($include_hidden = false) {
    global $db;
    if($include_hidden) {
        $results = $db->query("
            SELECT *
            FROM pages
        ");
    } else {
        $results = $db->query("
            SELECT *
            FROM pages
            WHERE hidden = 0
        ");
    }
    
    $pages = array();
    while($row = $results->fetch_assoc()) {
        $pages[] = $row;
    }
    
    return $pages;
}

function page_count($include_hidden = false) {
    global $db;
    if($include_hidden) {
        $results = $db->query("
            SELECT *
            FROM pages
        ");
    } else {
        $results = $db->query("
            SELECT *
            FROM pages
            WHERE hidden = 0
        ");
    }
    
    return $results->num_rows;
}

function get_page($id) {
    if(!$id) {
        return null;
    }
    
    global $db;
    $result = $db->query("
        SELECT *
        FROM pages
        WHERE id = '$id'
    ");
    
    $row = $result->fetch_assoc();
    return $row;
}

function page_exists($id) {
    if(!$id) {
        return false;
    }
    $page = get_page($id);
    return isset($page['id']);
}

function get_page_by_slug($slug) {
    if(!$slug) {
        return null;
    }
    
    global $db;
    $result = $db->query("
        SELECT *
        FROM pages
        WHERE slug = '$slug'
    ");
    
    $row = $result->fetch_assoc();
    return $row;
}

function page_exists_by_slug($slug) {
    if(!$slug) {
        return false;
    }
    $page = get_page_by_slug($slug);
    return isset($page['id']);
}

function add_page($pagedata) {
    $id = $pagedata['id'];
    if(!$id) {
        $id = 0;
    }

    $title = $pagedata['title'];
    $slug = $pagedata['slug'];
    $content = $pagedata['content'];
    $hidden = $pagedata['hidden'];
    if($hidden == 0) {
        $hidden = 0;
    } else {
        $hidden = 1;
    }
    
    global $db;
    if(!page_exists($id)) {
        $db->query("
            INSERT INTO pages () VALUES
            (NULL, '$title','$slug', '$content', '$hidden');
        ");
        $id = $db->insert_id;
        
    } else {
        $db->query("
            UPDATE pages
            SET title = '$title', slug = '$slug', content = '$content', hidden = '$hidden'
            WHERE id = $id;
        ");
        
    }
    
    return $id;
}

function update_page($pagedata) {
    return add_page($pagedata);
}

function delete_page($id) {
    if(!page_exists($id)) {
        return;
    }
    
    global $db;
    $db->query("
        DELETE FROM pages
        WHERE id = '$id';
    ");    
}

function get_page_title($id) {
    $page = get_page($id);
    if(!$page) {
        return null;
    }
    return $page['title'];
}

function get_page_slug($id) {
    $page = get_page($id);
    if(!$page) {
        return null;
    }
    return $page['slug'];
}

function get_page_contnet($id) {
    $page = get_page($id);
    if(!$page) {
        return null;
    }
    return $page['content'];
}

function is_page_hidden($id) {
    $page = get_page($id);
    if(!$page) {
        return false;
    }
    if($page['hidden']) {
        return true;
    }
    return false;
}

function get_page_url($id) {
    $slug = get_page_slug($id);
    return home_url($slug);
}

function get_page_edit_url($id) {
    return home_url("edit?id=$id");
}

function get_page_hide_url($id) {
    return home_url("edit-pages?action=hide&id=$id");
}

function get_page_unhide_url($id) {
    return home_url("edit-pages?action=unhide&id=$id");
}

function get_page_delete_url($id) {
    return home_url("edit-pages?action=delete&id=$id");
}

function hide_page($id) {
    $page = get_page($id);
    if(!$page) {
        return;
    }
    $page['hidden'] = 1;
    update_page($page);
}

function unhide_page($id) {
    $page = get_page($id);
    if(!$page) {
        return;
    }
    $page['hidden'] = 0;
    update_page($page);
}

function display_pages_list($add_ul = true) {
    $pages = get_all_pages();
    
    if(empty($pages)) {
        return;
    }
    
    if($add_ul) {
        echo '<ul>';
    }
    foreach($pages as $page) {
        if($page['hidden']) {
            continue;
        }
        echo '<li>';
        $url = get_page_url($page['id']);
        $title = $page['title'];
        echo '<a href="'.$url.'">'.$title.'</a>';
        echo '</li>';
    }
    if($add_ul) {
        echo '</ul>';
    }
}