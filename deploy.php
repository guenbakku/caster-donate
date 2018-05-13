<?php
namespace Deployer;

require 'recipe/common.php';
require './config.php';

/**
 * Create plugins' symlinks
 */
task('deploy:init', function () {
    run('{{release_path}}/bin/cake plugin assets symlink');
    run('{{release_path}}/bin/cake asset_compress build');
})->desc('Initialization');

/**
 * Run migrations
 */
task('deploy:run_migrations', function () {
    run('{{release_path}}/bin/cake migrations migrate');
    run('{{release_path}}/bin/cake migrations seed');
    run('{{release_path}}/bin/cake orm_cache clear');
    run('{{release_path}}/bin/cake orm_cache build');
})->desc('Run migrations');

/**
 * Main task
 */
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:init',
    'deploy:run_migrations',
    'deploy:copy_dirs',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
after('deploy:failed', 'deploy:unlock');
