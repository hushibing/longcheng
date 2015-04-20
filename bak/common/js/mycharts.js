/**
 * Created by Bing on 2015-01-12.
 */

$(function () {
    //var chart = new Highcharts.chart();
    //�������ݷ���
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
            text: '�������ݷ���'
        },
        tooltip: {
            tooltip:false,
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'�����������'
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
            name: 'ռ����������',
            data: []
        }]
    });

    //���������ݷ���
    chart_order_send = new Highcharts.Chart({
        chart: {
            renderTo:'container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '�����������ݷ���'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'�����������'
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


    //�˻������ݷ���
    $('#container_back').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '�˻��������ݷ���'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        credits:{
            enabled:true,
            href:'http://www.baidu.com',
            text:'�����������'
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
                ['����',   45.0],
                ['����',       26.8],
                {
                    name: '����',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['����',    8.5],
                ['�Ա�',     6.2],
                ['����',   0.5],
                ['һ��ͨ',   0.2],
            ]
        }]
    });

    //��Ʒ����
    $('#order_categorie').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '������ƷƷ��'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Africa','ƻ��','HTC','С��','��Ϊ'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '�������� (��)',
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
