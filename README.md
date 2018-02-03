# Elements
This is a simple library to construct HTML elements with PHP, mainly to avoid getting into a concatenation-hell.

## 1 Generating an element
### 1.1 Constructor
The first way to generate an Element is using its constructor.

It takes the following parameters

Parameter | Type | Description | Example | Default
--- | --- | --- | --- | ---
$tag | String | The HTML-tag | `'div'` | Required
$attributes | array | HTML-attributes | `['id' => 'wrap-god']` | `array()`
$content | array | The element's contents | `['hi', $span]` | `array()`

You can put everything into an Element's contents as long as it parses to a String, including other Elements.

```PHP
use Elements\Element;

$attributes = [
	'id' => 'wrap-god',
	'class' => ['fresh', 'mexican', 'tortilla'],
];

$div = new Element('div', $attributes);
```

Classes can be passed as Array (as shown here) or using a String, separating them with spaces (`'fresh mexican tortilla'`).
Note however that Strings will be exploded. As in the PHP-function.

### 1.2 Factory Method
There's also a fairly simple factory method for generating an Element only with a tag and the provided classes.
As mentioned before, you can either provide an Array of classes or seperate them by spaces.


Parameter | Type | Description | Example | Default
--- | --- | --- | --- | ---
$tag | String | The HTML-tag | `'span'` | Required
$classes | Array \| String | The classes | `'winged-hussar'` | Required

```PHP
use Elements\Element;

$div = Element::withClasses('div', 'undetected unexpected');
```

## 2. Modifying Attributes
Since Elements implement [ArrayAccess](http://php.net/manual/de/class.arrayaccess.php),
its attributes can be manipulated by accessing the Element like an Array.

Let's say we wanted to give an id to the Element created in 1.2. We would do it like this:
```PHP
$div['id'] = 'night-witch';
```

With the exception of classes and styles, all attributes are Strings.

### 2.1 Classes
Classes are internally handled as Arrays, as previously mentioned. This enables you to easily add and remove classes 
without having to worry about having one space too many or too few.

If you wanted to add some to our pre-existing div, you could do it like so:
```PHP
$div['class'][] = 'wings-of-glory';
$div['class'][] = 'tell-the-story';
```

Replacing them works in the same way as declaring them in the first place:
```PHP
$div['class'] = ['deviation', 'aviation'];
// or
$div['class'] = 'deviation aviation';
```

### 2.2 Styles
Styles are also handled as Arrays, however unlike classes, they are associative Arrays, since it'd be kind of hard otherwise.

You can add classes like so:
```PHP
$div['style']['display'] = 'none'; // Stealth perfected
```

Note that you can also pass a String to set an Element's styles, but it's not recommended since I can't guarantee that 
the regex will work 100% of the time. I didn't find any glaring issues, but I also didn't test a lot.

```PHP
$div['style'] = 'display: none; background: linear-gradient(to bottom, red, blue);'
```

## 3 Content
An Element's contents can be anything that parses to a String. They are kept as array and can be manipulated 
using the `addContent($content)` and `setContent(array $content)` methods.

Example:
```PHP
$div = Element::withClasses('div', 'form-group');

$input = new Element('input');
$input['type'] = 'text';

$div->addContent($input);
```

# 4 Outputting Elements
In order to output an Element, simply echo it or cast it to a string if you need to.

```PHP
echo $div;

$someString .= (string) $div;
```
