<?php

/**
 * DataObject classes can not be namespaced in SilverStripe 3.x
 *
 * @author zauberfisch
 * @property string $Content
 * @property int $VersionGroupPreviousID
 * @mixin zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension
 */
class mysite_ContentElement_Text extends \PageBuilder_Model_ContentElement_AbstractContentElement {
	private static $db = [
		'Content' => 'HTMLText',
	];
	private static $extensions = [
		\zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension::class,
	];

	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new \HtmlEditorField('Content', $this->fieldLabel('Content')));
		return $return;
	}

	public function getTitle() {
		return $this->Content ? $this->obj('Content')->Summary() : parent::getTitle();
	}
}
