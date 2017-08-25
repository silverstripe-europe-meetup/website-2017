<?php

namespace mysite;

use zauberfisch\SerializedDataObject\AbstractDataObject;

class MapMarker extends AbstractDataObject {
	private static $fields = [
		'Latitude',
		'Longitude',
		'Title',
		'Content',
		'Type',
	];
	
	public function getCMSFields() {
		$fields = new \FieldList();
		$fields->push(new \TextField('Latitude', $this->fieldLabel('Latitude')));
		$fields->push(new \TextField('Longitude', $this->fieldLabel('Longitude')));
		$fields->push(new \TextField('Title', $this->fieldLabel('Title')));
		$fields->push(new \TextareaField('Content', $this->fieldLabel('Content')));
		$fields->push(new \DropdownField('Type', $this->fieldLabel('Type'), [
			'hotel' => _t(self::class . '.TypeHotel', 'Hotel'),
			'conference' => _t(self::class . '.TypeConference', 'Conference'),
			'social' => _t(self::class . '.TypeSocial', 'Social'),
		]));
		return $fields;
	}
	
	public function getMapMarkerIconURL() {
		return \Director::absoluteURL([
			'hotel' => project() . '/images/map-icons/Hotel.png',
			'conference' => project() . '/images/map-icons/Conference.png',
			'social' => project() . '/images/map-icons/Party.png',
		][$this->getType()]);
	}
}
