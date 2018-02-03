<?php
namespace Element;

class ElementFactory {
	/**
	 * Creates an element with the given tag.
	 * @param  String  $tag Which tag the element should have.
	 * @return Element      The element.
	 */
	public static function make(string $tag) : Element {
		return new Element($tag);
	}
}
