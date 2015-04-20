/**
 * Created by Bing on 2015-01-12.
 */

$(function () {
    //var chart = new Highcharts.chart();
    //�������ݷ���
    chart_order_all = new Highcharts.Chart({
        chart: {
            renderTo:'containers_order_all',
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
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %',
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
            renderTo:'container_order_send',
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
            name: 'ռ��������������:',
            data: []
        }]
    });

    //�˻������ݷ���

    chart_order_back = new Highcharts.Chart({
        chart: {
            renderTo:'container_order_back',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '�˻��������ݷ���'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
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
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'ռ��',
            data: []
        }]
    });


    //δ�� δ�˻������ݷ���

    chart_order_not_send = new Highcharts.Chart({
        chart: {
            renderTo:'container_order_not_send',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'δ���������ݷ���'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
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
                    format: '<b>{point.name}</b>: {point.percentage:.2f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'ռδ��δ��������:',
            data: []
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
