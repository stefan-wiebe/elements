<?php
namespace Elements;

class Styles implements \ArrayAccess {
	private $styles;

	public function __construct(array $styles = array()) {
		$this->styles = $styles;
	}

	public function setStyles($styles) : void {
		if (is_array($styles)) {
			$this->styles = $styles;
		} elseif (is_string($styles)) {
			$matches = array();
			preg_match_all('/(\S+):\s*(.+?)\s*;/', $styles, $matches);

			for ($i = 0, $length = count($matches[1]); $i < $length; $i++) {
				$this->styles[$matches[1][$i]] = $matches[2][$i];
			}
		} else {
			throw InvalidArgumentException('Styles can only be set via string or array');
		}
	}

	public function __toString() : string {
		$string = '';
		$i = 0;
		$length = count($this->styles);

		foreach ($this->styles as $key => $value) {
			$string .= $key . ': ' . $value . ';';

			if (++$i !== $length) {
				$string .= ' ';
			}
		}

		return $string;
	}

	/* ArrayAccess Methods */
	public function offsetExists($offset) : bool {
		return isset($this->styles[$offset]);
	}

	public function offsetUnset($offset) : void {
		unset($this->styles[$offset]);
	}

	public function &offsetGet($offset) {
		return $this->styles[$offset];
	}

	public function offsetSet($offset, $value) : void {
		if ($offset === null) {
			$this->styles[] = $value;
		} else {
			$this->styles[$offset] = $value;
		}
	}
}
