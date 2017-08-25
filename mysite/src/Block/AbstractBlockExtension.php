<?php
//
//namespace mysite\Block;
//
//use zauberfisch\PageBuilder\Model\Block\Base;
//use zauberfisch\PageBuilder\Model\Block\ContentElement;
//use zauberfisch\PageBuilder\Model\Block\Group;
//
///**
// * Class mysite\Block\AbstractBlockExtension
// *
// * @property zauberfisch\PageBuilder\Model\Block\AbstractBlock $owner\
// */
//class AbstractBlockExtension extends \Extension {
//	/**
//	 * @param \FieldList $fields
//	 * @param $prefix
//	 * @param $pageBuilder
//	 * @param $blockPosition
//	 * @param $parent
//	 */
//	public function updatePageBuilderFields($fields, $prefix, $pageBuilder, $blockPosition, $parent) {
//		if (($this->owner->is_a(Group::class) && !$this->owner->is_a(Base::class)) || ($this->owner->is_a(ContentElement::class) && $this->owner->getContentElement()->is_a(\mysite_ContentElement_Text::class))) {
//			$fields->insertAfter($this->owner->getNameForField($prefix, 'BlockParent'), new \FieldGroup([
//				new \TextField(
//					$this->owner->getNameForField($prefix, 'MenuTitle'),
//					$this->owner->fieldLabel('MenuTitle'),
//					$this->owner->getMenuTitle()
//				),
//				(new \DropdownField(
//					$this->owner->getNameForField($prefix, 'BackgroundColor'),
//					$this->owner->fieldLabel('BackgroundColor'),
//					[
//						'white' => 'white',
//						'grey' => 'grey',
//						'black' => 'black',
//						'pink' => 'pink',
//						'blue' => 'blue',
//						'blue-dark' => 'blue-dark',
//						'blue-light' => 'blue-light',
//					],
//					$this->owner->getBackgroundColor()
//				))->setEmptyString('none'),
//			]));
//		}
//	}
//
//	public function updateExtraClass(&$classes) {
//		if ($this->owner->getBackgroundColor()) {
//			$classes[] = 'background-color';
//			$classes[] = 'background-color-' . $this->owner->getBackgroundColor();
//		}
//	}
//
//	public function getAnchor() {
//		return \Convert::raw2url($this->owner->getMenuTitle());
//	}
//}
