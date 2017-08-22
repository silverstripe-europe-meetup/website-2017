<?php

namespace Deployer;

require 'recipe/common.php';
require 'recipe/silverstripe.php';

// Hosts
//user and port is defined in .ssh/config
host('tb-silverstripe-01.twistedbytes.eu')
    ->stage('production')
    ->set('deploy_path', '/var/www/vhosts/TB01-007/2017.stripecon.eu/site');


// Configuration
set('bin/php', function () {
    return locateBinaryPath('php70');
});

set('default_stage', 'production');
set('repository', 'https://github.com/silverstripe-europe-meetup/website-2017.git');
set('git_tty', false); // [Optional] Allocate tty for git on first deployment; won't work on Windows

// Silverstripe shared dirs
set('shared_dirs', [
    'assets'
]);

// Silverstripe writable dirs
set('writable_dirs', [
    'assets'
]);

set('allow_anonymous_stats', false);


// Tasks
desc('update docroot symlink');
task('deploy:symlink-twistedbytes', function () {
    run("cd {{deploy_path}} && {{bin/symlink}} {{release_path}} docroot");
});

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'silverstripe:buildflush',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:symlink-twistedbytes',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
