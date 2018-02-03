<?php
namespace Element;

class Element implements \ArrayAccess {
	private $tag;
	private $attributes;
	private $content;

	private $omitsClosingTag;

	public function __construct(String $tag, array $attributes = array(), array $content = array()) {
		$this->setTag($tag);
		$this->setAttributes($attributes);
		$this->setContent($content);
	}

	public function openTag() : string {
		$tag = '<' . $this->tag . $this->attributes . '>';
		return $tag;
	}

	public function content() : string {
		return implode("\n", $this->content);
	}

	public function closeTag() : string {
		if (!$this->omitsClosingTag) {
			return '</' . $this->tag . '>';
		}
	}

	public function addContent($content) : void {
		if (!is_array($this->content)) {
			$this->content = array($this->content);
		}

		$this->content[] = $content;
	}

	public function setTag(string $tag) : void {
		$this->tag = $tag;
	}

	public function getTag() : string {
		return $this->tag;
	}

	/**
	 * Sets whether to omit the closing tag when outputting this element.
	 */
	public function setOmitsClosingTag(bool $omitsClosingTag = false) : void {
		$this->omitsClosingTag = $omitsClosingTag;
	}

	/**
	 * Returns whether or not the output tag will be omited when the element
	 * is output.
	 */
	public function omitsClosingTag() : bool {
		return $this->omitsClosingTag;
	}

	public function setAttributes(array $attributes) : void {
		if (!isset($this->attributes)) {
			$this->attributes = new Attributes($attributes);
		} else {
			$this->attributes->setAttributes($attributes);
		}
	}

	public function getAttributes() : Attributes {
		return $this->attributes;
	}

	public function setContent(array $content) : void {
		$this->content = $content;
	}

	public function getContent() : array {
		return $this->content;
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
		$this->attributes[$name] = $value;
	}

	public function __toString() : string {
		return $this->openTag() . $this->content() . $this->closeTag() . "\n";
	}
}
