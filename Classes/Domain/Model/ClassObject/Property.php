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
 * property representing a "property" in the context of software development
 *
 * @version $ID:$
 */
class Property extends \EBT\ExtensionBuilder\Domain\Model\AbstractObject {


	/**
	 * php var type of this property (read from @var annotation in doc comment)
	 *
	 * @var string type
	 */
	protected $varType;

	/**
	 * if there is a domain object property associated
	 * with this ClassProperty this object holds all extbase related information
	 * (like SQL, TYPO3 related stuff)
	 *
	 * @var object associatedDomainObjectProperty
	 */
	protected $associatedDomainObjectProperty = NULL;

	/**
	 * @var boolean
	 */
	protected $default;

	/**
	 *
	 * @var mixed
	 */
	protected $value;

	/**
	 * in case of properties of type array
	 * we need to preserve the parsed statements
	 * to be able to reapply the original
	 * linebrakes
	 *
	 * @var \PHPParser_NodeAbstract
	 */
	protected $defaultValueNode;

	/**
	 * __construct
	 *
	 * @param string
	 * @return void
	 */
	public function __construct($name) {
		$this->name = $name;
	}

	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return Property
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 *
	 * @return string $type.
	 */
	public function getVarType() {
		return $this->varType;
	}

	/**
	 * Sets $type.
	 *
	 * @param string $type
	 */
	public function setVarType($varType) {
		$this->setTag('var', array($varType));
		$this->varType = $varType;
	}


	/**
	 * Returns $associatedDomainObjectProperty.
	 *
	 * @return object associatedDomainObjectProperty
	 */
	public function getAssociatedDomainObjectProperty() {
		return $this->associatedDomainObjectProperty;
	}

	/**
	 * Sets $associatedDomainObjectProperty.
	 *
	 * @param object $associatedDomainObjectProperty
	 */
	public function setAssociatedDomainObjectProperty($associatedDomainObjectProperty) {
		$this->associatedDomainObjectProperty = $associatedDomainObjectProperty;
		if (empty($this->description)) {
			$this->description = $associatedDomainObjectProperty->getDescription();
			if (empty($this->description)) {
				$this->description = $this->name;
			}
		}
	}

	public function hasAssociatedDomainObjectProperty() {
		return !is_null($this->associatedDomainObjectProperty);
	}

	/**
	 *
	 * @return boolean
	 */
	public function isDefault() {
		return $this->default;
	}

	/**
	 *
	 * @param boolean $default
	 */
	public function setDefault($default) {
		$this->default = $default;
	}

	/**
	 *
	 * @return boolean
	 */
	public function getDefault() {
		return $this->default;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Setter for value
	 *
	 * @param mixed
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * This is a helper function to be called in fluid if conditions
	 * it returns TRUE even if the default value is 0 or an empty string or "FALSE"
	 * @return bool
	 */
	public function getHasDefaultValue() {
		if (isset($this->default) && $this->default !== NULL) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * This is a helper function to be called in fluid if conditions
	 * it returns TRUE even if the value is 0 or an empty string or "FALSE"
	 * @return bool
	 */
	public function getHasValue() {
		if (isset($this->value) && $this->value !== NULL) {
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * @param \PHPParser_NodeAbstract $defaultValueNode
	 */
	public function setDefaultValueNode($defaultValueNode) {
		$this->defaultValueNode = $defaultValueNode;
	}

	/**
	 *
	 * @return \PHPParser_NodeAbstract
	 */
	public function getDefaultValueNode() {
		return $this->defaultValueNode;
	}

}
