<?php
class Card {

	private $image;

	/**
	 * @param mixed $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	public function __construct($index) {
		$imagesBank = [
			'1.jpg', '2.jpg', '3.jpg', '4.jpg',
			'5.jpg', '6.jpg', '7.jpg', '8.jpg',
			'9.jpg', '10.jpg', '11.jpg', '12.jpg'
		];
		if (!isset($imagesBank[$index])) {
			throw new Exception( $index . " is Not a valid card");
		}
		$this->setImage($imagesBank[$index]);
	}
}