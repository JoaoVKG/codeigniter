<?php

function truncateHTML($html, $limit = 20) {
    static $wrapper = null;
    static $wrapperLength = 0;

    // trim unwanted CR/LF characters
    $html = trim($html);

    // Remove HTML comments
    $html = preg_replace("~<!--.*?-->~", '', $html);

    // If $html in in plain text
    if ((strlen(strip_tags($html)) > 0) && strlen(strip_tags($html)) == strlen($html))  {
        return substr($html, 0, $limit);
    }
    // If $html doesn't have a root element
    elseif (is_null($wrapper)) {
        if (!preg_match("~^\s*<[^\s!?]~", $html)) {
            // Defining a tag as our HTML wrapper
            $wrapper = 'div';
            $htmlWrapper = "<$wrapper></$wrapper>";
            $wrapperLength = strlen($htmlWrapper);
            $html = preg_replace("~><~", ">$html<", $htmlWrapper);
        }
    }

    // Calculating total length
    $totalLength = strlen($html);

    // If our input length is less than limit, we are done.
    if ($totalLength <= $limit) {
        if ($wrapper) {
            return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
        }
        return strlen(strip_tags($html)) > 0 ? $html : '';
    }

    // Initializing a DOM object to hold our HTML
    $dom = new DOMDocument;
    $dom->loadHTML($html,  LIBXML_HTML_NOIMPLIED  || LIBXML_HTML_NODEFDTD);
    // Initializing a DOMXPath object to query on our DOM
    $xpath = new DOMXPath($dom);
    // Query last node (this does not include comment or text nodes)
    $lastNode = $xpath->query("./*[last()]")->item(0);

    // While manipulating, when there is no HTML element left
    if ($totalLength > $limit && is_null($lastNode)) {
        if (strlen(strip_tags($html)) >= $limit) {
            $textNode = $xpath->query("//text()")->item(0);
            if ($wrapper) {
                $textNode->nodeValue = substr($textNode->nodeValue, 0, $limit );
                $html = $dom->saveHTML();
                return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
            } else {
                $lengthAllowed = $limit - ($totalLength - strlen($textNode->nodeValue));
                if ($lengthAllowed <= 0) {
                    return '';
                }
                $textNode->nodeValue = substr($textNode->nodeValue, 0, $lengthAllowed);
                $html = $dom->saveHTML();
                return strlen(strip_tags($html)) > 0 ? $html : '';
            }
        } else {
            $textNode = $xpath->query("//text()")->item(0);
            $textNode->nodeValue = substr($textNode->nodeValue, 0, -(($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $limit));
            $html = $dom->saveHTML();
            return strlen(strip_tags($html)) > 0 ? $html : '';
        }
    }
    // If we have a text node after our last HTML element
    elseif ($nextNode = $lastNode->nextSibling) {
        if ($nextNode->nodeType === 3 /* DOMText */) {
            $nodeLength = strlen($nextNode->nodeValue);
            // If by removing our text node total length will be greater than limit
            if (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength >= $limit) {
                // We should remove it
                $nextNode->parentNode->removeChild($nextNode);
                $html = $dom->saveHTML();
                return truncateHTML($html, $limit);
            }
            // If by removing our text node total length will be less than limit
            else {
                // We should truncate our text to fit the limit
                $nextNode->nodeValue = substr($nextNode->nodeValue, 0, ($limit - (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength)));
                $html = $dom->saveHTML();
                // Caring about custom wrapper
                if ($wrapper) {
                    return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
                }
                return $html;
            } 
        }
    }
    // If current node is an HTML element 
    elseif ($lastNode->nodeType === 1 /* DOMElement */) {
        $nodeLength = strlen($lastNode->nodeValue);
        // If by removing current HTML element total length will be greater than limit
        if (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength >= $limit) {
            // We should remove it
            $lastNode->parentNode->removeChild($lastNode);
            $html = $dom->saveHTML();
            return truncateHTML($html, $limit);
        }
        // If by removing current HTML element total length will be less than limit
        else {
            // We should truncate our node value to fit the limit
            $lastNode->nodeValue = substr($lastNode->nodeValue, 0, ($limit - (($totalLength - ($wrapperLength > 0 ? $wrapperLength : 0)) - $nodeLength)));
            $html = $dom->saveHTML();
            if ($wrapper) {
                return preg_replace("~^<$wrapper>|</$wrapper>$~", "", $html);
            }
            return $html;
        }
    }
}

?>