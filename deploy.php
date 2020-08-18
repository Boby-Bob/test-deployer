<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'test-deployer');

// Project repository
set('repository', 'https://github.com/Boby-Bob/test-deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('pro-dev.fr')
    ->set('deploy_path', '~/projects/test-deployer')
    ->port(51150);
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

