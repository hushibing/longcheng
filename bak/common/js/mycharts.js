/**
 * Created by Bing on 2015-01-12.
 */

$(function () {
    //var chart = new Highcharts.chart();
    //订单数据分析
    chart_order_all = new Highcharts.Chart({
        chart: {
            renderTo:'containers',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        exporting :{
            url:'http://export.hcharts.cn',
            height:600,
            width:600
        },
        title: {
            text: '订单数据分析'
        },
        tooltip: {
            tooltip:false,
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'怡达电子商务'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: '占订单总量：',
            data: []
        }]
    });

    //发货量数据分析
    chart_order_send = new Highcharts.Chart({
        chart: {
            renderTo:'container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '发货订单数据分析'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'怡达电子商务'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: []
        }]
    });


    //退货量数据分析
    $('#container_back').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '退货订单数据分析'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'怡达电子商务'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['建行',   45.0],
                ['招商',       26.8],
                {
                    name: '善融',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['民生',    8.5],
                ['淘宝',     6.2],
                ['邮乐',   0.5],
                ['一卡通',   0.2],
            ]
        }]
    });

    //商品分析
    $('#order_categorie').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '发货商品品类'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Africa','苹果','HTC','小米','华为'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '订单数据 (个)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203, 2]
        }
        ]
    });

});
