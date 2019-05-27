<?php
declare(strict_types=1);

namespace Nelexa\GPlay\Util;

class ScraperUtil
{
    /**
     * @param string $html
     * @return array
     */
    public static function extractScriptData(string $html): array
    {
        $scripts = [];
        if (preg_match_all('/>AF_initDataCallback[\s\S]*?<\/script/', $html, $matches)) {
            $scripts = array_reduce($matches[0], static function ($carry, $item) {
                if (
                    preg_match("/(ds:.*?)'/", $item, $keyMatch) &&
                    preg_match('/return ([\s\S]*?)}}\);<\//', $item, $valueMatch)
                ) {
                    $carry[$keyMatch[1]] = \GuzzleHttp\json_decode($valueMatch[1], true);
                }
                return $carry;
            }, $scripts);
        }
        return $scripts;
    }

    /**
     * @param string $html
     * @return string
     */
    public static function html2text(string $html): string
    {
        $doc = new \DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);
        if (!$doc->loadHTML('<?xml encoding="utf-8" ?>' . $html)) {
            throw new \RuntimeException('error load html: ' . $html);
        }
        libxml_use_internal_errors($internalErrors);
        $text = self::convertDomNodeToText($doc);
        $text = preg_replace('/\n{3,}/', "\n\n", trim($text));
        return trim($text);
    }

    /**
     * @param \DOMNode $node
     * @return string
     */
    private static function convertDomNodeToText(\DOMNode $node): string
    {
        if ($node instanceof \DOMText) {
            $text = preg_replace('/\s+/', ' ', $node->wholeText);
        } else {
            $text = '';
            if ($node->childNodes !== null) {
                foreach ($node->childNodes as $childNode) {
                    $text .= self::convertDomNodeToText($childNode);
                }
            }

            switch ($node->nodeName) {
                case 'h1':
                case 'h2':
                case 'h3':
                case 'h4':
                case 'h5':
                case 'h6':
                case 'p':
                case 'ul':
                case 'div':
                    $text = "\n\n" . $text . "\n\n";
                    break;
                case 'li':
                    $text = '- ' . $text . "\n";
                    break;
                case 'br':
                    $text .= "\n";
                    break;
            }
        }

        return $text;
    }
}
