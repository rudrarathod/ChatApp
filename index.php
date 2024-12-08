<?php

require_once 'assets/php/functions.php';
if (isset($_GET['newfp'])) {
    unset($_SESSION['auth_temp']);
    unset($_SESSION['forgot_email']);
    unset($_SESSION['forgot_code']);
}
if (isset($_SESSION['Auth'])) {
    $user = getUser($_SESSION['userdata']['id']);
    $posts = filterPosts();
    $follow_suggestions = filterFollowSuggestion();
}

$pagecount = count($_GET);


//manage pages
if (isset($_SESSION['Auth']) && $user['ac_status'] == 1 && !$pagecount) {
    showPage('header', ['page_title' => 'Home']);
    showPage('navbar');
    showPage('wall');
    showPage('navbar-bottom');
} elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 0 && !$pagecount) {

    showPage('header', ['page_title' => 'Verify Your Email']);
    showPage('verify_email');
} elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 2 && !$pagecount) {
    showPage('header', ['page_title' => 'Blocked']);
    showPage('blocked');
} elseif (isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'Edit Profile']);
    showPage('navbar');
    showPage('edit_profile');
    showPage('navbar-bottom');
}elseif (isset($_SESSION['Auth']) && isset($_GET['feedback']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'Feedback Forms']);
    showPage('navbar');
    showPage('feedback');
    showPage('navbar-bottom');
}
 elseif (isset($_SESSION['Auth']) && isset($_GET['post']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'post']);
    showPage('navbar');
    showPage('post');
    showPage('navbar-bottom');
}elseif (isset($_SESSION['Auth']) && isset($_GET['syllabus']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'post']);
    showPage('navbar');
    showPage('syllabus');
    showPage('navbar-bottom');
    
} elseif (isset($_SESSION['Auth']) && isset($_GET['u']) && $user['ac_status'] == 1) {
    $profile = getUserByUsername($_GET['u']);
    if (!$profile) {
        showPage('header', ['page_title' => 'User Not Found']);
        showPage('navbar');
        showPage('user_not_found');
        showPage('navbar-bottom');

    } else {
        $profile_post = getPostById($profile['id']);
        $profile['followers'] = getFollowers($profile['id']);
        $profile['following'] = getFollowing($profile['id']);
        showPage('header', ['page_title' => $profile['first_name'] . ' ' . $profile['last_name']]);
        showPage('navbar');
        showPage('profile');
        showPage('navbar-bottom');

    }
} elseif (isset($_GET['signup'])) {
    showPage('header', ['page_title' => 'MSM - SignUp']);
    showPage('signup');
}
elseif (isset($_GET['verify'])) {
    showPage('header', ['page_title' => 'MSM - SignUp']);
    showPage('verify');
}



elseif (isset($_GET['login'])) {

    showPage('header', ['page_title' => 'MSM - Login']);
    showPage('login');
} elseif (isset($_GET['forgotpassword'])) {

    showPage('header', ['page_title' => 'MSM - Forgot Password']);
    showPage('forgot_password');
} else {
    if (isset($_SESSION['Auth']) && $user['ac_status'] == 1) {
        showPage('header', ['page_title' => 'Home']);
        showPage('navbar');
        showPage('wall');
        showPage('navbar-bottom');

    } elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 0) {

        showPage('header', ['page_title' => 'Verify Your Email']);
        showPage('verify_email');
    } elseif (isset($_SESSION['Auth']) && $user['ac_status'] == 2) {
        showPage('header', ['page_title' => 'Blocked']);
        showPage('blocked');
    } else {
        showPage('header', ['page_title' => 'MSM - Login']);
        showPage('login');
    }
}


showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);
