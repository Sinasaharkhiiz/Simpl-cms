<?php

function get_all_users() {
    global $db;
        $results = $db->query("
            SELECT *
            FROM users
            
        ");

    $users = array();
    while($row = $results->fetch_assoc()) {
        $users[] = $row;
    }
    
    return $users;
}

function user_count() {
    global $db;
    $results = $db->query("
        SELECT *
        FROM users
    ");
    
   return $results->num_rows;
    
}
/*
function initialize_users() {
    if(user_count() == 0) {
        global $db;
        $default_pw_hash = sha1('admin');
        $db->query("
            INSERT INTO users (username, password, first_name, last_name) VALUES
            ('admin', '$default_pw_hash', '', '');
        ");
    }
}
*/
function get_user($username) {
    if(!$username) {
        return null;
    }
    
    global $db;
    $result = $db->query("
        SELECT *
        FROM users
        WHERE username = '$username'
    ");
    
    $row = $result->fetch_assoc();
    return $row;
}
function get_users($id) {
    if(!$id) {
        return null;
    }
    
    global $db;
    $result = $db->query("
        SELECT *
        FROM users
        WHERE id = '$id'
    ");
    
    $row = $result->fetch_assoc();
    return $row;
}
function user_exists($username) {
    $user = get_user($username);
    return isset($user['id']);
}

function add_user($userdata) {
    $username = $userdata['username'];
    if(!$username) {
        return;
    }
    
    $password = sha1($userdata['password']);
    $first_name = $userdata['first_name'];
    $last_name = $userdata['last_name'];
    
    global $db;
    if(!user_exists($username)) {
        $db->query("
            INSERT INTO users (username, password, first_name, last_name) VALUES
            ('$username', '$password', '$first_name', '$last_name');
        ");
        
    } else {
        $db->query("
            UPDATE users
            SET password = '$password', first_name = '$first_name', last_name = '$last_name'
            WHERE username = '$username';
        ");
        
    }
}

function update_user($userdata) {
    add_user($userdata);
}
function get_user_delete_url($id) {
    return home_url("edit-users?action=delete&id=$id");
}
function get_user_edit_url($id) {
    return home_url("edit-us?id=$id");
}
function delete_user($id) {
    if(!page_exists($id)) {
        return;
    }
    
    global $db;
    $db->query("
        DELETE FROM users
        WHERE id = '$id';
    ");    
}

