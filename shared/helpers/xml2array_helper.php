<?php
/**
 * Created by PhpStorm.
 * User: Bing
 * Date: 2015-04-14
 * Time: 14:43
 */
if (!function_exists("xml2array")) {
    function xml2array($xml)
    {
        $arr = null;
        if (empty($xml)) return false;
        $reader_xml = new XMLReader();
        $reader_xml->XML($xml);
        while ($reader_xml->read()) {
            if ($reader_xml->nodeType == XMLReader::END_ELEMENT) {
                return $arr;
            } else if ($reader_xml->nodeType == XMLReader::ELEMENT) {
                $node = array();
                $node['tag'] = $reader_xml->name;
                if ($reader_xml->hasAttributes) {
                    $attributes = array();
                    while ($reader_xml->moveToNextAttribute()) {
                        $attributes[$reader_xml->name] = $reader_xml->value;
                    }
                    $node['attr'] = $attributes;
                }
                if (!$reader_xml->isEmptyElement) {
                    $childs = xml2array($reader_xml);
                    $node['childs'] = $childs;
                }
                $arr[] = $node;
            } else if ($reader_xml->nodeType == XMLReader::TEXT) {
                $node = array();
                $node['text'] = $reader_xml->value;
                $arr[] = $node;
            }
        }

        $reader_xml->close();
        return $arr;

    }
}
