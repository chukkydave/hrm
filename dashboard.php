<?php
include("_common/header.php");
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">


        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard </h3>
            </div>

            <div class="title_right">
                <!-- <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div> -->
            </div>
        </div>

        <div class="clearfix"></div>


        <div class="row top_tiles">

            <a href="employees">
                <div class="animated flipInY col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                        <div class="count" id="no_employees">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_employees"></i>
                        </div>
                        <h3>Employees</h3>
                        <p>Total no. of Active Employees</p>
                    </div>
                </div>
            </a>

            <a href="leaves">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                        <div class="count" id="no_leaves">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_leaves"></i>
                        </div>
                        <h3>Leaves</h3>
                        <p>Pending Leaves</p>
                    </div>
                </div>
            </a>

            <a href="exits">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comments-o"></i></div>
                        <div class="count" id="no_terminations">
                            <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_terminations"></i>
                        </div>
                        <h3>Terminations</h3>
                        <p>Pending Terminations</p>
                    </div>
                </div>
            </a>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="display: none">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                    <div class="count" id="no_approvals">
                        <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: ; " id="load_approvals"></i>
                    </div>
                    <h3>HR Approvals</h3>
                    <p>Pending.</p>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square-o"></i></div>
                    <div class="count" id="no_total_salary">0
                        <i class="fa fa-spinner fa-spin fa-fw fa-1x" style="display: none; " id=""></i>
                    </div>
                    <h3>Total Salary</h3>
                    <p>Year-to-Date</p>
                </div>
            </div>

        </div>




        <div class="row">

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div id="echart_pie1"></div>
                    <div class="x_title">
                        <h2>Employment Status</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: ;" id="ddsh_loading" ></i> -->


                    </div>
                </div>
            </div>






            <!-- <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employee Cost</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="yearly_sales_report" style="height:350px;"></div>

                  </div>
                </div>
              </div> -->

        </div>







        <div class="row">

            <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Gender</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div id="echart_pie2" style="height:350px;"></div>

                    </div>
                  </div>
                </div> -->



        </div>

    </div>
</div>
</div>
<!-- /page content -->


<script type="text/javascript">
$(document).ready(function() {




    no_of_leaves();
    no_of_terminations();
    total_employees_not_terminated();

});

function total_employees_not_terminated() {
    // alert('success');
    var company_id = localStorage.getItem('company_id');

    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "company/count_total_company_employees_not_terminated",
        data: {
            "company_id": company_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError
        error: function(response) {

            $('#load_employees').hide();

            $('#no_employees').html('?');

        },

        success: function(response) {
            // console.log(response);

            if (response.status == '200') {
                $('#load_employees').hide();

                $('#no_employees').html(response['data']['total_count']);

            } else if (response.status == '401') {

                $('#load_employees').hide();

                $('#no_employees').html('?');
            }

        }
    });

}

function no_of_leaves() {
    // alert('success');
    var company_id = localStorage.getItem('company_id');


    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "hrm/pending_leaves_count",
        data: {
            "company_id": company_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError
        error: function(response) {

            $('#load_leaves').hide();

            $('#no_leaves').html('?');

        },

        success: function(response) {
            console.log(response);
            if (response.status == '200') {
                $('#load_leaves').hide();

                $('#no_leaves').html(response['data']['pending_leaves_count']);

            } else if (response.status == '401') {

                $('#load_leaves').hide();

                $('#no_leaves').html('?');
            }

        }
    });

}

function no_of_terminations() {
    // alert('success');
    var company_id = localStorage.getItem('company_id');

    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "hrm/terminations_count",
        data: {
            "company_id": company_id
        },
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError
        error: function(response) {


            $('#load_terminations').hide();

            $('#no_terminations').html('?');

        },

        success: function(response) {
            // console.log(response);
            // alert(response);

            if (response.status == '200') {
                $('#load_terminations').hide();

                $('#no_terminations').html(response['data']['terminations_count']);

            } else if (response.status == '401') {

                $('#load_terminations').hide();

                $('#no_terminations').html('?');
            }

        }
    });

}




function init_echarts() {

    if (typeof(echarts) === 'undefined') {
        return;
    }

    console.log('init_echarts');


    var theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'normal',
                color: '#408829'
            }
        },

        dataRange: {
            color: ['#1f610a', '#97b58d']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: '#408829',
                    type: 'dashed'
                },
                crossStyle: {
                    color: '#408829'
                },
                shadowStyle: {
                    color: 'rgba(200,200,200,0.3)'
                }
            }
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {
                    color: '#408829'
                },
                emphasis: {
                    color: '#408829'
                }
            }
        },

        k: {
            itemStyle: {
                normal: {
                    color: '#68a54a',
                    color0: '#a9cba2',
                    lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                    }
                }
            }
        },
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {
                    areaStyle: {
                        color: '#99d2dd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                }
            }
        },
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: '#408829'
                    }
                }
            }
        },
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: true,
                lineStyle: {
                    color: [
                        [0.2, '#86b379'],
                        [0.8, '#68a54a'],
                        [1, '#408829']
                    ],
                    width: 8
                }
            },
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                length: 18,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer: {
                length: '90%',
                color: 'auto'
            },
            title: {
                textStyle: {
                    color: '#333'
                }
            },
            detail: {
                textStyle: {
                    color: 'auto'
                }
            }
        },
        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };



    //echart Bar

    if ($('#mainb').length) {

        var echartBar = echarts.init(document.getElementById('mainb'), theme);

        echartBar.setOption({
            title: {
                text: 'Naira',
                subtext: '...'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['Salary']
            },
            toolbox: {
                show: false
            },
            calculable: false,
            xAxis: [{
                type: 'category',
                data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ]
            }],
            yAxis: [{
                type: 'value'
            }],
            series: [{
                name: 'Salary',
                type: 'bar',
                data: [700000.00, 2250000.00, 1130000.00, 2000000.00, 2000000.00, 2000000.00,
                    2000000.00, 2000000.00, 2000000.00, 2000000.00, 2000000.00, 2000000.00
                ],
                markPoint: {
                    data: [{
                        type: 'max',
                        name: '???'
                    }, {
                        type: 'min',
                        name: '???'
                    }]
                },
                markLine: {
                    data: [{
                        type: 'average',
                        name: '???'
                    }]
                }
            }]
        });

    }




    //echart Pie

    if ($('#echart_pie').length) {

        var company_id = localStorage.getItem('company_id');
        var echartPie = echarts.init(document.getElementById('echart_pie1'), theme);

        $.ajax({

            type: "POST",
            dataType: "json",
            url: api_path + "company/count_total_employee_for_each_company_employment_type",
            data: {
                "company_id": company_id
            },
            timeout: 60000,

            success: function(response) {

                console.log(response);

                if (response.status == '200') {

                    if (response.data.length != 0) {

                        var list_of_names = [];
                        var list_of_values = [];
                        $(response.data).each(function(index, value) {

                            list_of_names.push(value.name);
                            list_of_values.push({
                                value: Number(value.employee_count),
                                name: value.name
                            });

                        });


                        $("#ddsh_loading").hide(); //hidel loader



                        var echartDonut = echarts.init(document.getElementById('echart_pie'), theme);


                        var option = {
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            calculable: true,
                            legend: {
                                x: 'center',
                                y: 'bottom',
                                data: list_of_names
                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    magicType: {
                                        show: true,
                                        type: ['pie', 'funnel'],
                                        option: {
                                            funnel: {
                                                x: '25%',
                                                width: '50%',
                                                funnelAlign: 'center',
                                                max: 1548
                                            }
                                        }
                                    },
                                    restore: {
                                        show: true,
                                        title: "Restore"
                                    },
                                    saveAsImage: {
                                        show: true,
                                        title: "Save Image"
                                    }
                                }
                            },
                            series: [{
                                name: 'Total',
                                type: 'pie',
                                radius: ['35%', '55%'],
                                itemStyle: {
                                    normal: {
                                        label: {
                                            show: true
                                        },
                                        labelLine: {
                                            show: true
                                        }
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            position: 'center',
                                            textStyle: {
                                                fontSize: '14',
                                                fontWeight: 'normal'
                                            }
                                        }
                                    }
                                },
                                data: list_of_values
                            }]
                        }

                        echartDonut.setOption(option);

                    } else {


                        //no data available

                    }

                } else if (response.status == '400') {

                }

            },
            // objAJAXRequest, strError
            error: function(response) {
                alert('connection error');
                // $('#employee_details_display').hide();
                // $('#employee_error_display').show();

            }

        });

    }
}
</script>

<?php
include("_common/footer.php");
?>