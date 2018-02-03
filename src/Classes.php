<?php
namespace Element;

/**
 * Class for element classes.
 * Handles an Element's classes, since they are represented as array.
 */
class Classes implements \ArrayAccess {
	private $classes;

	public function __construct(array $classes = array()) {
		$this->classes = $classes;
	}

	public function setClasses($classes) : void {
		if (is_array($classes)) {
			$this->classes = $classes;
		} elseif (is_string($classes)) {
			$this->classes = explode(' ', $classes);
		} else {
			throw InvalidArgumentException('Classes can only be set via string or array');
		}
	}

	public function __toString() {
		return implode(' ', $this->classes);
	}

	/* ArrayAccess Methods */
	public function offsetExists($offset) : bool {
		return isset($this->classes[$offset]);
	}

	public function offsetUnset($offset) : void {
		unset($this->classes[$offset]);
	}

	public function &offsetGet($offset) {
		return $this->classes[$offset];
	}

	public function offsetSet($offset, $value) : void {
		if ($offset === null) {
			$this->classes[] = $value;
		} else {
			$this->classes[$offset] = $value;
		}
	}
}
