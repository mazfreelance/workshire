<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('admin.dashboard'), ['icon' => '<i class="icofont icofont-home"></i>']);
});

// Home > User Setting
Breadcrumbs::for('user_setting', function ($trail) {
    $trail->parent('home');
    $trail->push('User Setting');
});

// Home > User Setting > [Category]
Breadcrumbs::for('search_candidate', function ($trail) {
    $trail->parent('user_setting');
    $trail->push('Search Candidates', route('admin.search_candidate'));
});

Breadcrumbs::for('search_candidate_expired', function ($trail) {
    $trail->parent('user_setting');
    $trail->push('Search Candidates Duration', route('admin.candidate_expired'));
});