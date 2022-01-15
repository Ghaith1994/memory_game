<?php
require_once 'Card.php';
require_once 'Helpers/GameHandler.php';
class Game {
	const NUMBER_OF_CARDS = 12;
	const NUMBER_OF_ROWS = 4;
	const NUMBER_OF_COLUMNS = 6;

	private $board;
	private $numberOfCards;
	private $numberOfRows;
	private $numberOfColumns;
	private $remainingCards;
	private $attempt;
	private $previousIndex;
	private $currentIndex;

	/**
	 * @param mixed $currentIndex
	 */
	public function setCurrentIndex($currentIndex) {
		$this->currentIndex = $currentIndex;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentIndex() {
		return $this->currentIndex;
	}

	/**
	 * @param mixed $previousIndex
	 */
	public function setPreviousIndex($previousIndex) {
		$this->previousIndex = $previousIndex;
	}

	/**
	 * @return mixed
	 */
	public function getPreviousIndex() {
		return $this->previousIndex;
	}

	/**
	 * @param mixed $attemp
	 */
	public function setAttempt($attempt) {
		$this->attempt = $attempt;
	}

	/**
	 * @return mixed
	 */
	public function getAttempt() {
		return $this->attempt;
	}

	/**
	 * @param mixed $remainingCards
	 */
	public function setRemainingCards($remainingCards) {
		$this->remainingCards = $remainingCards;
	}

	/**
	 * @return mixed
	 */
	public function getRemainingCards() {
		return $this->remainingCards;
	}

	/**
	 * @param mixed $numberOfCards
	 */
	public function setNumberOfCards($numberOfCards) {
		$this->numberOfCards = $numberOfCards;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfCards() {
		return $this->numberOfCards;
	}

	/**
	 * @param mixed $numberOfColumns
	 */
	public function setNumberOfColumns($numberOfColumns) {
		$this->numberOfColumns = $numberOfColumns;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfColumns() {
		return $this->numberOfColumns;
	}

	/**
	 * @param mixed $numberOfRows
	 */
	public function setNumberOfRows($numberOfRows) {
		$this->numberOfRows = $numberOfRows;
	}

	/**
	 * @return mixed
	 */
	public function getNumberOfRows() {
		return $this->numberOfRows;
	}

	/**
	 * @param mixed $board
	 */
	public function setBoard($board) {
		$this->board = $board;
	}

	/**
	 * @return mixed
	 */
	public function getBoard() {
		return $this->board;
	}

	/**
	 * Gets a Card
	 * @param $index
	 * @return Card
	 */
	public function getCardInstance($index) {
		return new Card($index);
	}

	/**
	 * constructor
	 */
	public function __construct() {
		try {
			$this->setNumberOfCards(self::NUMBER_OF_CARDS);
			$this->setNumberOfRows(self::NUMBER_OF_ROWS);
			$this->setNumberOfColumns(self::NUMBER_OF_COLUMNS);
			$this->setRemainingCards($this->getNumberOfCards());
			$board = [];
			for ($i = 0; $i < $this->getNumberOfCards() ; $i++) {
				//$card = new Card($i);
				$card = $this->getCardInstance($i);
				$board[$i] = $card;
				$board[$this->getNumberOfCards() + $i] = $card;
			}
			$this->setBoard($board);
			$this->setAttempt(0);
			shuffle($this->board);
			GameHandler::setGame($this);
		} catch (Exception $e) {
			die('Error ' . $e->getMessage());
		}
	}

	/**
	 * unfolds a card according to a given index
	 * @param $index
	 * @return array
	 */
	public function uncoverCard($index) {
		$response = [];
		$board = $this->getBoard();
		$attempt = $this->getAttempt();
		$isMatch = false;
		if ($attempt == 0) {
			$this->setPreviousIndex($index);
		} else if ($attempt == 1) {
			$this->setPreviousIndex($this->getCurrentIndex());
		}
		$this->setCurrentIndex($index);
		$attempt++;
		if ($attempt == 2) {
			$isMatch = $this->isMatch();
			if ($isMatch) {
				$this->setRemainingCards($this->getRemainingCards() - 1);
			}
			$this->setPreviousIndex(null);
			$this->setCurrentIndex(null);
			$this->setAttempt(0);
		} else {
			$this->setAttempt($attempt);
		}
        GameHandler::setGame($this);
		$response['attempt'] = $this->getAttempt();
		$response['isMatch'] = $isMatch;
		$response['currentImage'] = $board[$index]->getImage();
		$response['remainingCards'] = $this->getRemainingCards();
		return $response;
	}

	/**
	 * Checks if 2 unfolded cards match
	 * @return bool
	 */
	private function isMatch() {
		$board = $this->getBoard();
		$previousIndex = $this->getPreviousIndex();
		$currentIndex = $this->getCurrentIndex();
		return ($board[$previousIndex]->getImage() == $board[$currentIndex]->getImage());
	}

}