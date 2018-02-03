<?php
namespace Element;

class ElementFactory {
	public function make(String $tag) : Element {
		return new Element($tag);
	}
}
