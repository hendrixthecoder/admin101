@extends('user.layouts.index')

@section('title', "$title - Dashboard")
@section('content')
<div class="app-content">
<div class="content-wrapper">
    <div class="container">
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
    
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    
    <!-- Chart code -->
    <script>
    am5.ready(function() {
    
    var data = [
      {
        id: "US",
        name: "United States",
        value: 100
      }, {
        id: "GB",
        name: "United Kingdom",
        value: 100
      }, {
        id: "CN",
        name: "China",
        value: 100
      }, {
        id: "IN",
        name: "India",
        value: 100
      }, {
        id: "AU",
        name: "Australia",
        value: 100
      }, {
        id: "CA",
        name: "Canada",
        value: 100
      }, {
        id: "BR",
        name: "Brasil",
        value: 100
      }, {
        id: "ZA",
        name: "South Africa",
        value: 100
      }
    ];
    
    var root = am5.Root.new("chartdiv");
    root.setThemes([am5themes_Animated.new(root)]);
    
    var chart = root.container.children.push(am5map.MapChart.new(root, {}));
    
    var polygonSeries = chart.series.push(
      am5map.MapPolygonSeries.new(root, {
        geoJSON: am5geodata_worldLow,
        exclude: ["AQ"]
      })
    );
    
    var bubbleSeries = chart.series.push(
      am5map.MapPointSeries.new(root, {
        valueField: "value",
        calculateAggregates: true,
        polygonIdField: "id"
      })
    );
    
    var circleTemplate = am5.Template.new({});
    
    bubbleSeries.bullets.push(function(root, series, dataItem) {
      var container = am5.Container.new(root, {});
    
      var circle = container.children.push(
        am5.Circle.new(root, {
          radius: 20,
          fillOpacity: 0.7,
          fill: am5.color(0xff0000),
          cursorOverStyle: "pointer",
          tooltipText: `{name}: [bold]{value}[/]`
        }, circleTemplate)
      );
    
      var countryLabel = container.children.push(
        am5.Label.new(root, {
          text: "{name}",
          paddingLeft: 5,
          populateText: true,
          fontWeight: "bold",
          fontSize: 13,
          centerY: am5.p50
        })
      );
    
      circle.on("radius", function(radius) {
        countryLabel.set("x", radius);
      })
    
      return am5.Bullet.new(root, {
        sprite: container,
        dynamic: true
      });
    });
    
    bubbleSeries.bullets.push(function(root, series, dataItem) {
      return am5.Bullet.new(root, {
        sprite: am5.Label.new(root, {
          text: "{value.formatNumber('#.')}",
          fill: am5.color(0xffffff),
          populateText: true,
          centerX: am5.p50,
          centerY: am5.p50,
          textAlign: "center"
        }),
        dynamic: true
      });
    });
    
    
    
    // minValue and maxValue must be set for the animations to work
    bubbleSeries.set("heatRules", [
      {
        target: circleTemplate,
        dataField: "value",
        min: 10,
        max: 50,
        minValue: 0,
        maxValue: 100,
        key: "radius"
      }
    ]);
    
    bubbleSeries.data.setAll(data);
    
    updateData();
    setInterval(function() {
      updateData();
    }, 2000)
    
    function updateData() {
      for (var i = 0; i < bubbleSeries.dataItems.length; i++) {
        bubbleSeries.data.setIndex(i, { value: Math.round(Math.random() * 100), id: data[i].id, name: data[i].name })
      }
    }
    
    
    }); // end am5.ready()
    </script>
    
    <!-- HTML -->
    
    {{-- amCharts --}}
    


@endsection