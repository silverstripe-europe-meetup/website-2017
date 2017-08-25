<?php

/**
 * DataObject classes can not be namespaced in SilverStripe 3.x
 *
 * @author zauberfisch
 * @property string $Title
 * @property string $Content
 * @property string $MapMarkers
 * @property int $VersionGroupPreviousID
 * @mixin zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension
 */
class mysite_ContentElement_Map extends \PageBuilder_Model_ContentElement_AbstractContentElement {
	private static $db = [
		'Title' => 'Varchar(255)',
		'Content' => 'HTMLText',
		'MapMarkers' => \zauberfisch\SerializedDataObject\DBField\ArrayListField::class,
	];
	private static $extensions = [
		\zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension::class,
	];
	
	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new \TextField('Title', $this->fieldLabel('Title')));
		$return->push(new \HtmlEditorField('Content', $this->fieldLabel('Content')));
		$return->push((new \zauberfisch\SerializedDataObject\Form\ArrayListField(
			'MapMarkers',
			$this->fieldLabel('MapMarkers'),
			\mysite\MapMarker::class
		)));
		return $return;
	}
}
