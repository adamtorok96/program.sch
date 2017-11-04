<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Program.sch');

// Project repository
set('repository', 'git@github.com:adamtorok96/program.sch.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', [
    '.env'
]);

add('shared_dirs', [
    'storage'
]);

add('writable_dirs', [
    'bootstrap',
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/framework',
    'storage/logs'
]);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('programsch')
    ->stage('prod')
    ->set('deploy_path', '/data/sites/program.sch.bme.hu/deployer')
    ->set('http_user', 'program.sch.bme.hu')
    ->set('writable_mode', 'chmod')
    ->set('writable_chmod_mode', '0775')
;
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');

task('assets', [
    'assets:create',
    'assets:upload'
]);

task('assets:create', function() {
    $build = askConfirmation('Dou you want to build assets?', true);

    if( $build ) {
        run('npm run prod', ['timeout' => null]);
    }
})->local();


task('assets:upload', function () {
    upload('public/css', '{{deploy_path}}/current/public/');
    upload('public/fonts', '{{deploy_path}}/current/public/');
    upload('public/js', '{{deploy_path}}/current/public/');
    upload('public/mix-manifest.json', '{{deploy_path}}/current/public/mix-manifest.json');
});

before('deploy', 'assets:create');
// 'deploy:prepare',
// 'deploy:lock',
// 'deploy:release',
// 'deploy:update_code',
// 'deploy:shared',
// 'deploy:writable',
// 'deploy:vendors',
//after('assets:upload', 'passport:install');
#after('deploy:vendors', 'artisan:migrate');
#after('artisan:migrate', 'npm:install');
#after('npm:install', 'npm:run');
// 'deploy:clear_paths',
// 'deploy:symlink',
// 'deploy:unlock',
after('deploy:unlock', 'assets:upload');
// 'cleanup',
// 'success'
