<?php
namespace Element;

class Element implements \ArrayAccess {
	private $tag;
	private $attributes;
	private $content;

	private $omitsClosingTag;

	const VOID_ELEMENTS = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img',
						   'input', 'link', 'meta', 'param', 'source', 'track',
						   'wbr'];

	public function __construct(string $tag, array $attributes = array(), array $content = array()) {
		$this->setTag($tag);
		$this->setAttributes($attributes);
		$this->setContent($content);
	}

	public static function withClasses(string $tag, $classes) : self {
		return new Element($tag, ['class' => $classes]);
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
		} else {
			return '';
		}
	}

	public function addContent($content) : self {
		if (!is_array($this->content)) {
			$this->content = array($this->content);
		}

		$this->content[] = $content;
		return $this;
	}

	public function setTag(string $tag) : self {
		if (in_array($tag, self::VOID_ELEMENTS)) {
			$this->setOmitsClosingTag();
		}

		$this->tag = $tag;
		return $this;
	}

	public function getTag() : string {
		return $this->tag;
	}

	/**
	 * Sets whether to omit the closing tag when outputting this element.
	 */
	public function setOmitsClosingTag(bool $omitsClosingTag = true) : self {
		$this->omitsClosingTag = $omitsClosingTag;
		return $this;
	}

	/**
	 * Returns whether or not the output tag will be omited when the element
	 * is output.
	 */
	public function omitsClosingTag() : bool {
		return $this->omitsClosingTag;
	}

	public function setAttributes(array $attributes) : self {
		if (!isset($this->attributes)) {
			$this->attributes = new Attributes($attributes);
		} else {
			$this->attributes->setAttributes($attributes);
		}

		return $this;
	}

	public function getAttributes() : Attributes {
		return $this->attributes;
	}

	public function setContent(array $content) : self {
		$this->content = $content;
		return $this;
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
