<?php

/**
 * parse XML by XMLReader
 * User: Bing
 * Date: 2015-04-14
 * Time: 16:42
 */
class xml2array
{

    private $xml = '';

    public function __construct()
    {
    }

    /**
     * 功能：加载xml数据
     * @param $xml
     * @return array|null
     */

    public function parser_xml($xml,$tag_name='')
    {
        $read_xml = new XMLReader();
        if (substr($xml,0,4)=='http') {
            //加载XML文件
            $read_xml->open($xml);
        } else {
            //加载xml数据字符
            $read_xml->XML($xml);
        }

        if (empty($tag_name)) {
            $xml_array = $this->xml2array($read_xml);
        } else {
            $xml_array = $this->xml_tag_2arrary($read_xml);
        }
        return $xml_array;

    }

    /**
     * 功能：按xml节点关系创建多维数据
     * @param $reader_xml ：XML对象
     * @return array|null
     */
    function xml2array($reader_xml)
    {
        $arr = null;
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
                    $childs = $this->xml2array($reader_xml);
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



    /**
     * 获取指定节点内的数据
     * @param $reader_xml
     * @param string $tag
     * @return array|null
     */
    public function xml_tag_2arrary($reader_xml, $tag_name = '')
    {
        $arr = null;

        while ($reader_xml->read()) {

            if ($reader_xml->name == "Order") {

                switch ($reader_xml->nodeType) {
                    case XMLReader::END_ELEMENT:
                        return $arr;
                    case XMLReader::ELEMENT:
                        //$node = array();
                        $tag_name = $reader_xml->name;
                        $node['tag'] = $tag_name;
                        if ($reader_xml->hasAttributes) {
                            $attributes = array();
                            while ($reader_xml->moveToNextAttribute()) {
                                $attributes[$reader_xml->name] = $reader_xml->value;
                            }
                            $node['attr'] = $attributes;
                        }
                        //属性读完后，读取xml节点的指针 在继续移动到了它的字节点：文本或元素(TEXT or ELEMENT)
                        if (!$reader_xml->isEmptyElement) {
                            //再读取tag_name的子节点,这里使用了无tag_name做递归运算
                            $childs = $this->xml2array($reader_xml);
                            $node['childs'] = $childs;
                        }
                        $arr[] = $node;
                    case XMLReader::TEXT:
                        $node = array();
                        if ($reader_xml->value) {
                            $node['text'] = $reader_xml->value;
                            $arr[] = $node;
                        }
                }
            }
        }
        $reader_xml->close();
        return $arr;

    }

}

