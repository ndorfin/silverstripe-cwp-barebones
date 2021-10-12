<?php

namespace ShaunBareBones;

use CWP\CWP\PageTypes\BasePage;
use SilverStripe\Forms\TextField;

class Page extends BasePage {
    private static $db = [
        'PageHeading' => 'Text',
    ];

    public function getCMSFields() {
      $fields = parent::getCMSFields();
      $fields->addFieldToTab('Root.Main', TextField::create('PageHeading','Custom heading for this page'));
  
      return $fields;
    }
}
