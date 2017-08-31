<?php

/**
 * DataObject classes can not be namespaced in SilverStripe 3.x
 *
 * @author zauberfisch
 * @property string $Title
 * @property string $Website
 * @property string $Content
 * @property int $VersionGroupPreviousID
 * @property int $LogoID
 * @method Image Logo()
 * @mixin zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension
 */
class mysite_ContentElement_Sponsor extends \PageBuilder_Model_ContentElement_AbstractContentElement {
	private static $db = [
		'Title' => 'Varchar(255)',
		'Website' => 'Varchar(1000)',
		'Content' => 'Text',
	];
	private static $has_one = [
		'Logo' => 'Image',
	];
	private static $extensions = [
		\zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension::class,
	];
	
	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new TextField('Title', $this->fieldLabel('Title')));
		$return->push(new TextField('Website', $this->fieldLabel('Website')));
		$return->push(new TextareaField('Content', $this->fieldLabel('Content')));
		$return->push(
			(new UploadField('Logo', $this->fieldLabel('Logo')))
				->setFolderName('sponsors')
		);
		return $return;
	}
	
	public function getWebsiteLinkTitle() {
		return trim(preg_replace('/^(https?:|)\/\//', '', trim($this->Website)), '/');
	}
}
