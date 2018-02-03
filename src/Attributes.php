<?php
namespace Element;

class Attributes implements \ArrayAccess {
	private $attributes;

	public function __construct($attributes = array()) {
		$this->setAttributes($attributes);
	}

	/**
	 * Adds an attibute while respecting already existing values for classes.
	 * @param string $name  The name of the attribute
	 * @param mixed  $value The value of the attribute
	 */
	public function put(string $name, $value) : void {
		switch ($name) {
			case 'class':
				if (is_array($value)) {
					$this->attributes['class'] = $value;
				} elseif (is_string($value)) {
					$this->attributes['class'] = explode(' ', $value);
				}
				break;
			default:
				$this->attributes[$name] = $value;
				break;
		}
	}

	/**
	 * Clears this element's attributes, replacing it with an empty array.
	 */
	public function clear() : void {
		$this->attributes = array();
	}

	public function setAttributes(array $attributes) : void {
		$this->attributes = $attributes;
	}

	public function getAttributes() : array {
		return $this->attributes;
	}

	public function __toString() {
		$string = ' ';

		$i = 0;
		$length = count($this->attributes);

		foreach ($this->attributes as $attribute => $value) {
			$string .= $attribute . '="';

			if (is_array($value)) {
				$string .= implode(' ', $value);
			} else {
				$string .= $value;
			}

			$string .= '"';

			if (++$i !== $length) {
				$string .= ' ';
			}
		}

		return $string;
	}

	/* ArrayAccess Methods */
	public function offsetExists($name) : bool {
		return isset($this->attributes[$name]);
	}

	public function offsetUnset($name) : void {
		unset($this->attributes[$name]);
	}

	public function &offsetGet($name) {
		return $this->attributes[$name];
	}

	public function offsetSet($name, $value) : void {
		$this->put($name, $value);
	}
}
