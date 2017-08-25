<?php

namespace mysite;

/**
 * Class mysite\SiteConfigExtension
 *
 * @property SiteConfig|mysite\SiteConfigExtension $owner
 */
class SiteConfigExtension extends \DataExtension {
	public function updateCMSFields(\FieldList $fields) {
		$fields->removeByName('Theme');
	}
}
