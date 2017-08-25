<?php

namespace mysite\Block;

use zauberfisch\PageBuilder\Model\Block\Group;

/**
 * @author zauberfisch
 * @method string getMenuTitle
 * @method $this setMenuTitle(string $nchor)
 * @method string getBackgroundColor
 * @method $this setBackgroundColor(string $color)
 */
class PageSectionGroup extends Group {
	private static $fields = [
		'MenuTitle',
		'BackgroundColor',
	];
	
	public function getPageBuilderFields($prefix, $pageBuilder, $blockPosition = 0, $parent = null) {
		$return = parent::getPageBuilderFields($prefix, $pageBuilder, $blockPosition, $parent);
		$return->insertAfter($this->getNameForField($prefix, 'BlockParent'), new \FieldGroup([
			new \TextField(
				$this->getNameForField($prefix, 'MenuTitle'),
				$this->fieldLabel('MenuTitle'),
				$this->getMenuTitle()
			),
			(new \DropdownField(
				$this->getNameForField($prefix, 'BackgroundColor'),
				$this->fieldLabel('BackgroundColor'),
				[
					'white' => 'white',
					'grey' => 'grey',
					'black' => 'black',
					'pink' => 'pink',
					'blue' => 'blue',
					'blue-dark' => 'blue-dark',
					'blue-light' => 'blue-light',
				],
				$this->getBackgroundColor()
			))->setEmptyString('none'),
		]));
		return $return;
	}
	
	public function extraClass() {
		if ($this->getBackgroundColor()) {
			$this->addExtraClass('background-color');
			$this->addExtraClass('background-color-' . $this->getBackgroundColor());
		}
		return parent::extraClass();
	}
	
	public function getAnchor() {
		return \Convert::raw2url($this->getMenuTitle());
	}
}
