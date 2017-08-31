<?php

namespace mysite;

use zauberfisch\PageBuilder\Form\Field;

/**
 * Class mysite\SiteConfigExtension
 *
 * @property SiteConfig|mysite\SiteConfigExtension $owner
 */
class SiteConfigExtension extends \DataExtension {
	private static $db = [
		'FooterPageBuilder' => \zauberfisch\PageBuilder\Model\DBField::class,
	];
	
	public function updateCMSFields(\FieldList $fields) {
		$fields->addFieldsToTab('Root.Main', [
			new Field('FooterPageBuilder', $this->owner->fieldLabel('FooterPageBuilder')),
		]);
		$fields->removeByName('Theme');
	}
}
