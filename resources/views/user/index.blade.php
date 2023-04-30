@extends('user.layouts.index')

@section('title', "$title - Dashboard")
@section('content')
<div class="app-content">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 " >
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container" >
                    <div id="tradingview_879e7" style="height: 300px"></div>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>@lang('messages.dashboard')</h1>
                </div>
            </div>
        </div>
        @if (Session::has('successTrans'))
            <div class="row">
                <div class="col-xl-4">
                    <div class="alert alert-success">
                        <h4 class="text-center">
                            {{ Session::get('successTrans') }}
                        </h4>
                    </div>
                </div>
            </div>
        @endif
        @if (session()->has('message'))
        <div class="text-center alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <a href="{{ route('deposits') }}" type="button" class="btn btn-primary mb-4 mt-2">
                    <i class="material-icons-two-tone">add</i>@lang('messages.newDeposits')
                </a>
                    
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.wallet')</span>
                                <span class="widget-stats-amount">${{ $balance }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-negative align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 4%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.packCap')</span>
                                <span class="widget-stats-amount">${{ $running_plan_capital }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-negative align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 4%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">new_label</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.profits')</span>
                                <span class="widget-stats-amount">${{ $profit }}</span>
                                {{-- <span class="widget-stats-info">790 unique this month</span> --}}
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 12%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">groups</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.referralBonus')</span>
                                <span class="widget-stats-amount">${{ $referralBonus }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 12%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-danger">
                                <i class="material-icons-outlined">inventory_2</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.totalPackages')</span>
                                <span class="widget-stats-amount">{{ $plansCount }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 7%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-danger">
                                <i class="material-icons-outlined">inventory_2</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.totalWithdrawal')</span>
                                <span class="widget-stats-amount">{{ $withdrawalCount }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 7%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chartdiv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Styles -->
<style>
    #chartdiv {
      width: 100%;
      height: 600px
    }
    </style>

    {{-- Trading View Scripts --}}
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
    new TradingView.widget(
    {
    "autosize": true,
    "symbol": "NASDAQ:AAPL",
    "interval": "D",
    "timezone": "Etc/UTC",
    "theme": "dark",
    "style": "1",
    "locale": "en",
    "toolbar_bg": "#f1f3f6",
    "enable_publishing": false,
    "allow_symbol_change": true,
    "container_id": "tradingview_879e7"
  }
    );
    </script>
    
   
    
    <!-- HTML -->
    
    {{-- amCharts --}}
    <!-- Styles -->
<style>
    #chartdiv {
      width: 100%;
      height: 600px;
    }
    </style>
    
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    
    <!-- Chart code -->
    <script>
    am5.ready(function() {
    
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");
    
    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    var data = [
      {
        name: "Monica",
        steps: 45688,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/monica.jpg"
        }
      },
      {
        name: "Joey",
        steps: 35781,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/joey.jpg"
        }
      },
      {
        name: "Ross",
        steps: 25464,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/ross.jpg"
        }
      },
      {
        name: "Phoebe",
        steps: 18788,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/phoebe.jpg"
        }
      },
      {
        name: "Rachel",
        steps: 15465,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/rachel.jpg"
        }
      },
      {
        name: "Chandler",
        steps: 11561,
        pictureSettings: {
          src: "https://www.amcharts.com/wp-content/uploads/2019/04/chandler.jpg"
        }
      }
    ];
    
    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(
      am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "none",
        wheelY: "none",
        paddingLeft: 50,
        paddingRight: 40
      })
    );
    
    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    
    var yRenderer = am5xy.AxisRendererY.new(root, {});
    yRenderer.grid.template.set("visible", false);
    
    var yAxis = chart.yAxes.push(
      am5xy.CategoryAxis.new(root, {
        categoryField: "name",
        renderer: yRenderer,
        paddingRight:40
      })
    );
    
    var xRenderer = am5xy.AxisRendererX.new(root, {});
    xRenderer.grid.template.set("strokeDasharray", [3]);
    
    var xAxis = chart.xAxes.push(
      am5xy.ValueAxis.new(root, {
        min: 0,
        renderer: xRenderer
      })
    );
    
    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    var series = chart.series.push(
      am5xy.ColumnSeries.new(root, {
        name: "Income",
        xAxis: xAxis,
        yAxis: yAxis,
        valueXField: "steps",
        categoryYField: "name",
        sequencedInterpolation: true,
        calculateAggregates: true,
        maskBullets: false,
        tooltip: am5.Tooltip.new(root, {
          dy: -30,
          pointerOrientation: "vertical",
          labelText: "{valueX}"
        })
      })
    );
    
    series.columns.template.setAll({
      strokeOpacity: 0,
      cornerRadiusBR: 10,
      cornerRadiusTR: 10,
      cornerRadiusBL: 10,
      cornerRadiusTL: 10,
      maxHeight: 50,
      fillOpacity: 0.8
    });
    
    var currentlyHovered;
    
    series.columns.template.events.on("pointerover", function(e) {
      handleHover(e.target.dataItem);
    });
    
    series.columns.template.events.on("pointerout", function(e) {
      handleOut();
    });
    
    function handleHover(dataItem) {
      if (dataItem && currentlyHovered != dataItem) {
        handleOut();
        currentlyHovered = dataItem;
        var bullet = dataItem.bullets[0];
        bullet.animate({
          key: "locationX",
          to: 1,
          duration: 600,
          easing: am5.ease.out(am5.ease.cubic)
        });
      }
    }
    
    function handleOut() {
      if (currentlyHovered) {
        var bullet = currentlyHovered.bullets[0];
        bullet.animate({
          key: "locationX",
          to: 0,
          duration: 600,
          easing: am5.ease.out(am5.ease.cubic)
        });
      }
    }
    
    
    var circleTemplate = am5.Template.new({});
    
    series.bullets.push(function(root, series, dataItem) {
      var bulletContainer = am5.Container.new(root, {});
      var circle = bulletContainer.children.push(
        am5.Circle.new(
          root,
          {
            radius: 34
          },
          circleTemplate
        )
      );
    
      var maskCircle = bulletContainer.children.push(
        am5.Circle.new(root, { radius: 27 })
      );
    
      // only containers can be masked, so we add image to another container
      var imageContainer = bulletContainer.children.push(
        am5.Container.new(root, {
          mask: maskCircle
        })
      );
    
      // not working
      var image = imageContainer.children.push(
        am5.Picture.new(root, {
          templateField: "pictureSettings",
          centerX: am5.p50,
          centerY: am5.p50,
          width: 60,
          height: 60
        })
      );
    
      return am5.Bullet.new(root, {
        locationX: 0,
        sprite: bulletContainer
      });
    });
    
    // heatrule
    series.set("heatRules", [
      {
        dataField: "valueX",
        min: am5.color(0xe5dc36),
        max: am5.color(0x5faa46),
        target: series.columns.template,
        key: "fill"
      },
      {
        dataField: "valueX",
        min: am5.color(0xe5dc36),
        max: am5.color(0x5faa46),
        target: circleTemplate,
        key: "fill"
      }
    ]);
    
    series.data.setAll(data);
    yAxis.data.setAll(data);
    
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
    cursor.lineX.set("visible", false);
    cursor.lineY.set("visible", false);
    
    cursor.events.on("cursormoved", function() {
      var dataItem = series.get("tooltip").dataItem;
      if (dataItem) {
        handleHover(dataItem)
      }
      else {
        handleOut();
      }
    })
    
    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();
    chart.appear(1000, 100);
    
    }); // end am5.ready()
    </script>
    
    <!-- HTML -->

    


@endsection