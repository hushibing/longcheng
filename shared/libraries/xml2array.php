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
     * ���ܣ�����xml����
     * @param $xml
     * @return array|null
     */

    public function parser_xml($xml,$tag_name='')
    {
        $read_xml = new XMLReader();
        if (substr($xml,0,4)=='http') {
            //����XML�ļ�
            $read_xml->open($xml);
        } else {
            //����xml�����ַ�
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
     * ���ܣ���xml�ڵ��ϵ������ά����
     * @param $reader_xml ��XML����
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
     * ��ȡָ���ڵ��ڵ�����
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
                        //���Զ���󣬶�ȡxml�ڵ��ָ�� �ڼ����ƶ����������ֽڵ㣺�ı���Ԫ��(TEXT or ELEMENT)
                        if (!$reader_xml->isEmptyElement) {
                            //�ٶ�ȡtag_name���ӽڵ�,����ʹ������tag_name���ݹ�����
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

