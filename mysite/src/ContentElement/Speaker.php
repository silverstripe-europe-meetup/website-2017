<?php

/**
 * DataObject classes can not be namespaced in SilverStripe 3.x
 *
 * @author zauberfisch
 * @property string $Title
 * @property string $Website
 * @property string $TwitterHandle
 * @property string $GitHubHandle
 * @property string $Content
 * @property int $VersionGroupPreviousID
 * @property int $ImageID
 * @method Image Image()
 * @mixin zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension
 */
class mysite_ContentElement_Speaker extends \PageBuilder_Model_ContentElement_AbstractContentElement {
	private static $db = [
		'Title' => 'Varchar(255)',
		'Website' => 'Varchar(1000)',
		'TwitterHandle' => 'Varchar(255)',
		'GitHubHandle' => 'Varchar(255)',
		'Content' => 'Text',
	];
	private static $has_one = [
		'Image' => 'Image',
	];
	private static $extensions = [
		\zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension::class,
	];
	
	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new TextField('Title', $this->fieldLabel('Title')));
		$return->push(new TextField('Website', $this->fieldLabel('Website')));
		$return->push(new TextField('TwitterHandle', $this->fieldLabel('TwitterHandle')));
		$return->push(new TextField('GitHubHandle', $this->fieldLabel('GitHubHandle')));
		$return->push(new TextareaField('Content', $this->fieldLabel('Content')));
		$return->push(
			(new UploadField('Image', $this->fieldLabel('Image')))
				->setFolderName('speakers')
		);
		return $return;
	}
	
	public function getWebsiteLinkTitle() {
		return trim(preg_replace('/^(https?:|)\/\//', '', trim($this->Website)), '/');
	}
	
	public function getTwitterLink() {
		return $this->TwitterHandle ? "https://twitter.com/{$this->TwitterHandle}" : null;
	}
	
	public function getGitHubLink() {
		return $this->GitHubHandle ? "https://github.com/{$this->GitHubHandle}" : null;
	}
}
