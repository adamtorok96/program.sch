<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Program.sch');

// Project repository
set('repository', 'https://github.com/adamtorok96/program.sch.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('project.com')
    ->set('deploy_path', '~/{{application}}')
;
    
// Tasks

task('assets', [
    'assets:create',
    'assets:upload'
]);

task('assets:create', function () {
    run('npm install', ['timeout' => null]);
    run('npm run prod', ['timeout' => null]);
})->local();

task('assets:upload', function () {
    upload('public/css', '{{release_path}}/public/');
    upload('public/fonts', '{{release_path}}/public/');
    upload('public/js', '{{release_path}}/public/');
    upload('public/mix-manifest.json', '{{release_path}}/public/mix-manifest.json');
});