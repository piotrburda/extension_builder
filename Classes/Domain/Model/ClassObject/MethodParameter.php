<?php
namespace EBT\ExtensionBuilder\Domain\Model\ClassObject;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Nico de Haen
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * parameter representing a method parameter in
 * the context of software development
 *
 */
class MethodParameter extends \EBT\ExtensionBuilder\Domain\Model\AbstractObject{

	/**
	 *
	 * @var string
	 */
	protected $varType;

	/**
	 * @var mixed
	 */
	protected $typeHint = NULL;

	/**
	 * @var null
	 */
	protected $typeForParamTag = NULL;

	/**
	 *
	 * @var mixed
	 */
	protected $defaultValue;

	/**
	 *
	 * @var int
	 */
	protected $position;

	/**
	 *
	 * @var boolean
	 */
	protected $optional;

	/**
	 * @var int
	 */
	protected $startLine = -1;

	/**
	 * @var int
	 */
	protected $endLine = -1;

	/**
	 *
	 * @var boolean
	 */
	protected $passedByReference;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct($name) {
		$this->name = $name;
	}


	/**
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Returns $varType.
	 *
	 */
	public function getVarType() {
		if (empty($this->varType) && !empty($this->typeHint)) {
			return $this->typeHint;
		}
		return $this->varType;
	}

	/**
	 * Sets $varType.
	 *
	 * @param object $varType
	 */
	public function setVarType($varType) {
		$this->varType = $varType;
		return $this;
	}

	/**
	 *
	 * @return int $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * setter for position
	 *
	 * @param int $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}


	/**
	 * getter for defaultValue
	 * @return mixed
	 */
	public function getDefaultValue() {
		return $this->defaultValue;
	}

	/**
	 * setter for defaultValue
	 * @param $defaultValue
	 * @return $this
	 */
	public function setDefaultValue($defaultValue = NULL) {
		$this->defaultValue = $defaultValue;
		return $this;
	}

	/**
	 *
	 * @return boolean
	 */
	public function isOptional() {
		return $this->optional;
	}

	/**
	 *
	 * @param $optional
	 * @return void
	 */
	public function setOptional($optional) {
		$this->optional = $optional;
	}

	/**
	 *
	 * @return boolean
	 */
	public function isPassedByReference() {
		return $this->passedByReference;
	}

	/**
	 * @return boolean
	 */
	public function getPassedByReference() {
		return $this->passedByReference;
	}

	/**
	 * @param boolean $passedByReference
	 */
	public function setPassedByReference($passedByReference) {
		$this->passedByReference = $passedByReference;
	}

	/**
	 *
	 * @return
	 */
	public function getTypeHint() {
		return $this->typeHint;
	}

	/**
	 * Sets $typeHint.
	 *
	 * @param string $typeHint
	 * @return $this
	 */
	public function setTypeHint($typeHint) {
		$this->typeHint = $typeHint;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasTypeHint() {
		return !empty($this->typeHint);
	}

	/**
	 * @param string $typeForParamTag
	 */
	public function setTypeForParamTag($typeForParamTag) {
		$this->typeForParamTag = $typeForParamTag;
	}

	/**
	 * @return string|null
	 */
	public function getTypeForParamTag() {
		return $this->typeForParamTag;
	}

	/**
	 * @param int $startLine
	 */
	public function setStartLine($startLine) {
		$this->startLine = $startLine;
	}

	/**
	 * @return int
	 */
	public function getStartLine() {
		return $this->startLine;
	}

	/**
	 * @param int $endLine
	 */
	public function setEndLine($endLine) {
		$this->endLine = $endLine;
	}

	/**
	 * @return int
	 */
	public function getEndLine() {
		return $this->endLine;
	}

}
