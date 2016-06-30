<?php
namespace ElementareTeilchen\Fluid\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This view helper parses the given Fluid string.
 *
 * = Examples =
 * 
 * <code title="Inline">
 * {et:parse(string:'text containing a {variable} variable')}
 * </code>
 * <output>
 * text containing a value variable
 * </output>
 * 
 * <code title="Tag">
 * <et:parse>text containing a {variable} variable</et:parse>
 * </code>
 * <output>
 * text containing a value variable
 * </output>
 */
class ParseViewHelper extends AbstractViewHelper {

    /**
     * @var \TYPO3\Fluid\Core\Parser\TemplateParser
     * @Flow\Inject
     */
    protected $templateParser;

    /**
     * Initializes the "string" argument
     */
    public function __construct() {
        $this->registerArgument('string', 'string', 'String to parse.');
    }

    /**
     * @return string parsed string
     */
    public function render() {
        if ($this->arguments['string'] === NULL) {
            $string = $this->renderChildren();
        } else {
            $string = $this->arguments['string'];
        }
        return $this->templateParser->parse($string)->render($this->renderingContext);
    }
}