<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
use SilverStripe\FullTextSearch\Solr\Solr;
use SilverStripe\Core\Config\Config;
use SilverStripe\i18n\i18n;
use SilverStripe\Comments\Admin\CommentAdmin;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);

// Sets Locale to English New Zealand
i18n::set_locale('en_NZ');

/**
 * Force use of www and SSL in the domain
 */
if(Director::isLive() && !Director::is_cli()) {
    Director::forceSSL();
    Director::forceWWW();
}

/**
 * Allows Solr to be configured locally in Development
 * on the current docker-compose configuration
 */
if (Director::isDev() && Environment::getEnv('SS_SOLR_ENABLED')) {
    Solr::configure_server([
        'host'       => 'solr',
        'indexstore' => [
            'mode'       => 'file',
            'path'       => '/var/solr',
            'remotepath' => '/var/solr'
        ]
    ]);
}
