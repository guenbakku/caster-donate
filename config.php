<?php
namespace Deployer;

// Project name
set('application', 'Caster Donate');

// Project repository
set('repository', 'ssh://git@redmine.nvb-online.com/cast-donate/gl-caster-donate.git');

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', [
    'logs',
    'storage/dynamic',
    'webroot/img/avatar',
    'webroot/resources/audio/private',
    'webroot/resources/img/private',
]);

// Writable dirs by web server 
set('writable_dirs', [
    'storage/dynamic',
    'webroot/img/avatar',
    'webroot/resources/audio/private',
    'webroot/resources/img/private',
]);
set('writable_mode', 'chown');
set('writable_use_sudo', true);

// Hosts

host('test-1')
    ->hostname('test.toilensong.com')
    ->stage('test')
    ->user('ec2-user')
    ->identityFile('~/.ssh/private_keys/toilensong.pem')
    ->set('http_user', 'apache')
    ->set('deploy_path', '/var/www/html/_toilensong');    
