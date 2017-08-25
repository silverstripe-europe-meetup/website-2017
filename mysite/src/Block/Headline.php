<?php

namespace mysite\Block;

use zauberfisch\PageBuilder\Model\Block\AbstractBlock;

/**
 * @author zauberfisch
 * @method string getHeadlineLevel
 * @method string getPreTitle
 * @method string getTitle
 * @method $this setHeadlineLevel(string $level)
 * @method $this setPreTitle(string $width)
 * @method $this setTitle(string $width)
 */
class Headline extends AbstractBlock {
	private static $fields = [
		'PreTitle',
		'Title',
		'HeadlineLevel',
	];
	
	public function getPageBuilderFields($prefix, $pageBuilder, $blockPosition = 0, $parent = null) {
		$return = parent::getPageBuilderFields($prefix, $pageBuilder, $blockPosition, $parent);
		$return->push(
			new \FieldGroup([
				(new \TextField($this->getNameForField($prefix, 'HeadlineLevel'), $this->fieldLabel('HeadlineLevel'), $this->getHeadlineLevel() ?: 2))
					->setAttribute('type', 'number')
					->setAttribute('min', '1')
					->setAttribute('max', '6'),
				new \TextField($this->getNameForField($prefix, 'PreTitle'), $this->fieldLabel('PreTitle'), $this->getPreTitle()),
				new \TextField($this->getNameForField($prefix, 'Title'), $this->fieldLabel('Title'), $this->getTitle()),
			])
		);
		return $return;
	}
}
