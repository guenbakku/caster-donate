# Caster-donate deploy script

## Installation

1. Install required dependencies via Composer

    ~~~
    $ composer install
    ~~~

1. Copy required private keys into `/keys` folder 

    1. `repository.pem`
    1. `server.pem`
    1. e.t.c

## Deployment

Run following command

~~~
$ vendor/bin/dep deploy {stage} --branch {branch-name}
~~~

or

~~~
$ vendor/bin/dep deploy {stage} --tag {tag-name}
~~~

or

~~~
$ vendor/bin/dep deploy {stage} --revision {revision-hash}
~~~

More info: https://deployer.org/docs