<script type="text/javascript">
    $(function() {
        Highcharts.setOptions({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                },
            },
            title: {
                style: {
                    color: '#000',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                style: {
                    color: '#666666',
                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            legend: {
                itemStyle: {
                    font: '9pt Trebuchet MS, Verdana, sans-serif',
                    color: 'black'
                },
                itemHoverStyle:{
                    color: 'gray'
                }   
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                candlestick: {
                    lineColor: '#000000'
                }
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 6000
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        
        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'grafik_female',
            },
            title: {
                text: 'KMS Perempuan'
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            yAxis: {
                title: {
                    text: 'Berat Badan'
                },
                tickInterval : 1,
            },
            xAxis: {
                title: {
                    text: 'Umur'
                },
                tickInterval : 1
            },
            series: [
            {
                name: 'BB Lebih',
                data: [
                4.8,6.2,7.4,8.4,9.2,9.8,
                10.4,10.9,11.4,11.8,12.2,
                12.5,12.9,13.2,13.6,13.9,
                14.2,14.5,14.8,15.1,15.4,
                15.7,16.0,16.3,16.6,
                ],
            },{
                name: 'BB Normal',
                data: [
                4.2,5.5,6.6,7.5,8.2,8.8,
                9.3,9.8,10.2,10.5,10.9,
                11.2,11.5,11.8,12.1,12.4,
                12.6,12.9,13.2,13.5,13.7,
                14.0,14.3,14.6,14.9,
                ],
            },{
                name: 'BB Kurang',
                data: [
                2.4,3.1,3.9,4.5,5.0,5.4,
                5.7,6.0,6.2,6.5,6.7,
                6.9,7.0,7.2,7.4,7.6,
                7.7,7.9,8.1,8.2,8.4,
                8.6,8.7,8.9,9.0,
                ],
            },{
                name: 'BB Sangat Kurang',
                data: [
                2.0,2.8,3.4,4.0,4.4,4.8, //0-5
                5.1,5.3,5.6,5.8,6.0, //6-10
                6.1,6.3,6.4,6.6,6.8, //11-15
                6.9,7.0,7.2,7.3,7.5, //16-20
                7.6,7.8,7.9,8.1,
                ],
            },
            ]
        });
    });

    $(function() {
        Highcharts.setOptions({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                },
            },
            title: {
                style: {
                    color: '#000',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                style: {
                    color: '#666666',
                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            legend: {
                itemStyle: {
                    font: '9pt Trebuchet MS, Verdana, sans-serif',
                    color: 'black'
                },
                itemHoverStyle:{
                    color: 'gray'
                }   
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                candlestick: {
                    lineColor: '#404048'
                }
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 6000
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        
        var chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'grafik_male',
                type: 'line'
            },
            title: {
                text: 'KMS Laki-Laki'
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            yAxis: {
                title: {
                    text: 'Berat Badan'
                },
                tickInterval : 1,
            },
            xAxis: {
                title: {
                    text: 'Umur'
                },
                tickInterval : 1
            },
            series: [
            {
                name: 'BB Lebih',
                data: [
                5.0,6.5,7.9,8.9,9.6,10.3,
                10.9,11.3,11.8,12.2,12.5,
                12.9,13.2,13.5,13.8,14.2,
                14.5,14.8,15.1,15.4,15.7,
                16.0,16.3,16.6,16.9,
                ],
            },{
                name: 'BB Normal',
                data: [
                4.4,5.8,7.1,8.0,8.7,9.3,
                9.8,10.3,10.7,11.0,11.4,
                11.7,12.0,12.3,12.6,12.8,
                13.1,13.4,13.6,13.9,14.2,
                14.4,14.7,15.0,15.2,
                ],
            },{
                name: 'BB Kurang',
                data: [
                2.5,3.4,4.3,5.0,5.5,6.0,
                6.3,6.7,6.9,7.1,7.3,
                7.6,7.7,7.9,8.1,8.3,
                8.4,8.6,8.8,8.9,9.1,
                9.2,9.4,9.5,9.7,
                ],
            },{
                name: 'BB Sangat Kurang',
                data: [
                2.1,2.9,3.8,4.4,4.9,5.3,
                5.7,5.9,6.2,6.4,6.6,
                6.8,6.9,7.1,7.3,7.4,
                7.6,7.7,7.8,8.0,8.1,
                8.2,8.4,8.5,8.6,
                ],
            },
            ]
        });
    });

    $(function() {
        Highcharts.setOptions({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                },
            },
            title: {
                style: {
                    color: '#000',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                style: {
                    color: '#666666',
                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            legend: {
                itemStyle: {
                    font: '9pt Trebuchet MS, Verdana, sans-serif',
                    color: 'black'
                },
                itemHoverStyle:{
                    color: 'gray'
                }   
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                candlestick: {
                    lineColor: '#000000'
                }
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 6000
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        
        var chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'grafik1_female',
            },
            title: {
                text: 'KMS Perempuan'
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            yAxis: {
                title: {
                    text: 'Berat Badan'
                },
                pointStart: 7,
                tickInterval : 1,
            },
            xAxis: {
                title: {
                    text: 'Umur'
                },
                pointStart: 25,
                tickInterval : 1,
            },
            series: [
            {
                name: 'BB Lebih',
                data: [
                17.0,17.3,17.6,17.9,18.3,18.6,
                18.9,19.2,19.5,19.8,20.1,
                20.4,20.8,21.1,21.4,21.8,
                22.1,22.4,22.8,23.1,23.4,
                23.8,24.1,24.5,24.8,25.2,
                25.5,25.9,26.2,26.5,26.9,
                27.3,27.6,27.9,28.3,28.6,
                ],
            },{
                name: 'BB Normal',
                data: [
                15.1,15.4,15.7,16.0,16.2,16.5,
                16.8,17.0,17.3,17.6,17.9,
                18.1,18.4,18.7,19.0,19.2,
                19.5,19.8,20.1,20.4,20.7,
                20.9,21.2,21.5,21.8,22.1,
                22.4,22.7,22.9,23.2,23.5,
                23.8,24.1,24.4,24.6,24.9,
                ],
            },{
                name: 'BB Kurang',
                data: [
                9.2,9.3,9.5,9.7,9.8,10.0,
                10.1,10.3,10.4,10.5,10.7,
                10.8,10.9,11.1,11.2,11.3,
                11.4,11.6,11.7,11.8,12.0,
                12.1,12.2,12.3,12.4,12.6,
                12.7,12.8,12.9,13.0,13.2,
                13.3,13.4,13.5,13.6,13.7,
                ],
            },{
                name: 'BB Sangat Kurang',
                data: [
                8.2,8.3,8.5,8.6,8.8,8.9,
                9.0,9.1,9.2,9.4,9.5,
                9.6,9.7,9.8,10.0,10.1,
                10.2,10.3,10.4,10.5,10.6,
                10.7,10.8,10.9,11.0,11.1,
                11.2,11.3,11.4,11.5,11.6,
                11.7,11.8,11.9,12.0,12.1,
                ],
            },
            ]
        });
    });

    $(function() {
        Highcharts.setOptions({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                },
            },
            title: {
                style: {
                    color: '#000',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                style: {
                    color: '#666666',
                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            legend: {
                itemStyle: {
                    font: '9pt Trebuchet MS, Verdana, sans-serif',
                    color: 'black'
                },
                itemHoverStyle:{
                    color: 'gray'
                }   
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    marker: {
                        enabled: false
                    },
                    pointStart: 25,
                    tickInterval : 1,
                },
                candlestick: {
                    lineColor: '#404048'
                }
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 6000
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        
        var chart4 = new Highcharts.Chart({
            chart: {
                renderTo: 'grafik1_male',
                type: 'line'
            },
            title: {
                text: 'KMS Laki-Laki'
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            yAxis: {
                title: {
                    text: 'Berat Badan'
                },
                pointStart: 7,
                tickInterval : 1,
            },
            xAxis: {
                title: {
                    text: 'Umur'
                },
                allowDecimals: true
            },
            series: [
            {
                name: 'BB Lebih',
                data: [
                17.2,17.5,17.9,18.2,18.4,18.8,
                19.0,19.3,19.6,19.9,20.2,
                20.4,20.7,21.0,21.2,21.5,
                21.8,22.1,22.4,22.6,22.9,
                23.2,23.5,23.8,24.1,24.3,
                24.6,24.9,25.2,25.5,25.8,
                26.1,26.4,26.7,27.0,27.3,
                ],
                color: '#f2f200',
            },{
                name: 'BB Normal',
                data: [
                15.6,15.8,16.1,16.3,16.6,16.9,
                17.1,17.3,17.6,17.8,18.1,
                18.3,18.5,18.8,19.0,19.2,
                19.5,19.7,20.0,20.2,20.4,
                20.7,21.0,21.2,21.4,21.7,
                21.9,22.2,22.4,22.7,22.9,
                23.2,23.4,23.7,23.9,24.1
                ],
                color: '#39b500',
            },{
                name: 'BB Kurang',
                data: [
                9.8,10.0,10.1,10.2,10.4,10.5,
                10.6,10.8,10.9,11.0,11.2,
                11.3,11.4,11.5,11.7,11.8,
                11.9,12.0,12.1,12.2,12.4,
                12.5,12.6,12.7,12.8,12.9,
                13.0,13.2,13.3,13.4,13.5,
                13.6,13.7,13.9,14.0,14.1
                ],
                color: '#39b500',
            },{
                name: 'BB Sangat Kurang',
                data: [
                8.8,8.9,9.0,9.1,9.2,9.4,
                9.5,9.6,9.7,9.8,9.9,
                10.0,10.1,10.2,10.3,10.4,
                10.5,10.6,10.7,10.8,10.9,
                11.0,11.1,11.2,11.3,11.4,
                11.5,11.6,11.7,11.8,11.9,
                12.0,12.1,12.2,12.3,12.4,
                ],
                color: '#ff0000',
                fillColor: null,
            },
            ]
        });
    });
</script>

<script type="text/javascript">
    // GRAFIK MALE
    $(function() {
        var data_viewer = <?php echo $grafik; ?>;

        Highcharts.chart('salesChart', {
            colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
            chart: {
                backgroundColor: null,
            },
            title: {
                text: 'KMS Laki-Laki',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    textTransform: 'uppercase'
                },
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            xAxis: {
                title: {
                    text: 'Umur',
                    style: {
                        textTransform: 'uppercase'
                    },
                },
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            series: [{
                type: 'scatter',
                marker: {
                    enabled: true,
                    symbol: 'cross',
                    fillColor: '#000',
                    lineColor: '#FFF'
                },
                name: 'BB',
                data: data_viewer
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    })
</script>