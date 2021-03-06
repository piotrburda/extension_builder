<?php
namespace EBT\ExtensionBuilder\Domain\Model;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Nico de Haen
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

use EBT\ExtensionBuilder\Domain\Model\ClassObject\ClassObject;

/**
 * Provides methods that are common to Class, File and Namespace objects
 *
 */

class Container extends AbstractObject {

	/**
	 * constants
	 * associative array constName => constValue
	 *
	 * @var array
	 */
	protected $constants = array();

	/**
	 * @var array
	 */
	protected $preIncludes = array();

	/**
	 * @var array
	 */
	protected $postIncludes = array();

	/**
	 * @var array FunctionObject[]
	 */
	protected $functions = array();

	/**
	 * contains all statements that occurred before the first class statement
	 *
	 * @var array
	 */
	protected $preClassStatements = array();

	/**
	 * contains all statements that occurred after the first class statement
	 * they will be rewritten after the last class!!
	 *
	 * @var array
	 */
	protected $postClassStatements = array();


	/**
	 * @var array ClassObject[]
	 */
	protected $classes = array();


	/**
	 * @return ClassObject
	 */
	public function getFirstClass() {
		$classes = $this->getClasses();
		return reset($classes);

	}

	/**
	 * @param ClassObject $class
	 */
	public function addClass(ClassObject $class) {
		$this->classes[] = $class;
	}

	/**
	 * @param array ClassObject[]
	 */
	public function setClasses($classes) {
		$this->classes = $classes;
		return $this;
	}

	/**
	 * @return ClassObject[]
	 */
	public function getClasses() {
		return $this->classes;
	}


	/**
	 * Setter for a single constant
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return Container
	 */
	public function setConstant($name, $value) {
		$this->constants[$name] = $value;
		return $this;
	}


	/**
	 * Getter for constants
	 *
	 * @return string constants
	 */
	public function getConstants() {
		return $this->constants;
	}

	/**
	 * Getter for a single constant
	 *
	 * @param $constantName
	 * @return mixed constant value
	 */
	public function getConstant($constantName) {
		if (isset($this->constants[$constantName])) {
			return $this->constants[$constantName];
		}
		else return NULL;
	}

	/**
	 * removes a constant
	 *
	 * @param string $constantName
	 * @return boolean TRUE (if successfull removed)
	 */
	public function removeConstant($constantName) {
		if (isset($this->constants[$constantName])) {
			unset($this->constants[$constantName]);
			return TRUE;
		}
		return FALSE;
	}

	public function addPostInclude($postInclude) {
		$this->postIncludes[] = $postInclude;
	}

	public function getPostIncludes() {
		return $this->postIncludes;
	}

	public function addPreInclude($preInclude) {
		$this->preIncludes[] = $preInclude;
	}

	public function getPreIncludes() {
		return $this->preIncludes;
	}

	/**
	 * @param array FunctionObject[]
	 */
	public function setFunctions(array $functions) {
		$this->functions = $functions;
	}

	/**
	 * @param FunctionObject $function
	 */
	public function addFunction(FunctionObject $function) {
		$this->functions[$function->getName()] = $function;
	}

	/**
	 * @return array FunctionObject[]
	 */
	public function getFunctions() {
		return $this->functions;
	}

	/**
	 * @param string $name
	 * @return FunctionObject
	 */
	public function getFunction($name) {
		if (isset($this->functions[$name])) {
			return $this->functions[$name];
		} else {
			return NULL;
		}
	}

	/**
	 * @param array $postClassStatements
	 */
	public function addPostClassStatements($postClassStatements) {
		$this->postClassStatements[] = $postClassStatements;
	}

	/**
	 * @return array
	 */
	public function getPostClassStatements() {
		return $this->postClassStatements;
	}

	/**
	 * @param array $preClassStatements
	 */
	public function addPreClassStatements($preClassStatements) {
		$this->preClassStatements[] = $preClassStatements;
	}

	/**
	 * @return array
	 */
	public function getPreClassStatements() {
		return $this->preClassStatements;
	}
}
