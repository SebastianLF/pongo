/**
 * Created by sebs on 28/04/2015.
 */
var chartData = {
    "type": "bar",
    "background-color":"#fff",
    "series": [
        {"values": [35, 42, 67, 89, 25, 34, 67, 85]},
        {"values": [28, 57, 43, 56, 78, 99, 67, 28]}
    ]
};

var chartData2 = {
    "type":"line",
    "background-color":"#fff",
    "plot":{
        "aspect":"spline"
    },
    "series": [
        {"values": [35, 42, 67, 89, 25, 34, 67, 85]},
        {"values": [28, 57, 43, 56, 78, 99, 67, 28]}
    ]
};

var chartPie1 = {
    "type":"pie3d",
    "background-color":"#fff",
    "series":[
        {
            "text":"Apples",
            "values":[5]
        },
        {
            "text":"Oranges",
            "values":[8]
        },
        {
            "text":"Bananas",
            "values":[22]
        },
        {
            "text":"Grapes",
            "values":[16]
        },
        {
            "text":"Cherries",
            "values":[12]
        }
    ]
};

zingchart.render({
    id: 'chartPie1',
    height: 400,
    width: '100%',
    data: chartPie1
});

zingchart.render({
    id: 'chartDiv',
    height: 400,
    width: '100%',
    data: chartData
});
zingchart.render({
    id: 'chartData2',
    height: 400,
    width: '100%',
    data: chartData2
});
zingchart.render({
    id: 'tipsterPie1',
    height: 400,
    width: '100%',
    data: chartPie1
});

// tipsters
$('#tipster_stats').select2({
    allowClear: true,
    placeholder: "Choisir un tipster",
    cache: true,
    ajax: {
        url: 'tipsters',
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data
            };
        }
    }
});