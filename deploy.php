<?php
namespace Deployer;

require 'recipe/cakephp.php';

// Project name
set('application', 'Caster Donate');

// Project repository
set('repository', 'ssh://git@redmine.nvb-online.com/cast-donate/gl-caster-donate.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', [
    'logs',
    
]);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('project.com')
    ->set('deploy_path', '~/{{application}}');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

