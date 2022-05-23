<link rel="stylesheet" href="/assets/min/admin.min.css">
<main class="admin-site">
	<div class="admin-details-wrap">
		<div class="admin-hello">
		    <div class="hello-text">
        	    <h5 class="heading">Hi Lucky Luke!</h2>
        	    <p>Welcome! Manage your all tasks & daily work here.</p>
        	</div>
        </div>
        <div class="navigation">
            <h3>Dashboard</h3>
            <div class="chart-select">
                <a href="/earnings" class="category active" >Earned Amount</a>
                <a href="/orders" class="category" >Amount of Sales</a>
                <a href="" class="category">Amount of Signups</a>
                <a href="" class="category" >Daily Active Users</a>
                <a href="" class="category">Captcha Requests</a>
            </div>
        </div>
		<div class="admin-chart">
		    <div class="report">
		        <div class="money">
		            <div class="amount" id="amount"></div>
		            <div class="caption" id="captionAmount">Earnings per Week</div>
		        </div>
		        <div class="time">
		            <div class="caption" id="timerange">Last 7 days</div>
		        </div>
		    </div>
            <canvas id="dateTimeChart" width="450" height="200"></canvas>
		</div>
	</div>
	<div class="sidebar">
	    <div class="controls">
	        <div class="bell"><img src="/assets/icons/admin/bell.svg" width="24"/></div>
	        <div class="admin"><img src="/assets/icons/admin/avatar.svg" width=32/>Admin</div>
	    </div>
        <input id="datepicker" hidden value="0"/>
        <div class="forms">
            <div class="ban">
                <label for="username">Ban User Text Field</label>
                <input id="username" placeholder="Name"/>
                <button class="ban-btn" type="button">Ban</button>
            </div>
            <div class="select">
                <label for="username">Add Package to User field</label>
                <select>
                    <option>Los Angeles</option>
                </select>
                <button class="add-btn">Add Package</button>
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.1.7/dist/index.umd.min.js"></script>
<script>

Chart.defaults.LineWithLine = Chart.defaults.line;
Chart.controllers.LineWithLine = Chart.controllers.line.extend({
   draw: function(ease) {
      Chart.controllers.line.prototype.draw.call(this, ease);

      if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
         var activePoint = this.chart.tooltip._active[0],
             ctx = this.chart.ctx,
             x = activePoint.tooltipPosition().x,
             topY = this.chart.legend.bottom,
             bottomY = this.chart.chartArea.bottom;

         // draw line
         ctx.save();
         ctx.beginPath();
         ctx.moveTo(x, topY);
         ctx.lineTo(x, bottomY);
         ctx.lineWidth = 2;
         ctx.strokeStyle = '#07C';
         ctx.stroke();
         ctx.restore();
      }
   }
});

const picker = new easepick.create({
    element: "#datepicker",
    inline: true,
    readonly: false,
    css: [
        "/assets/min/calendar.css"
    ],
    zIndex: 10,
    plugins: [
        "RangePlugin"
    ]
});
function sort_objects(a, b) {
    return new Date(a["date"]).getTime() - new Date(b["date"]).getTime();
}

var data;
var sorted_data;
function lastweek(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    var list = [];
    var i = 0;
    var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    while(i < 7){
        let weekday = mm + '-' + (dd-i) + '-' + yyyy;
        i = i + 1;
        list.push(days[new Date(weekday).getDay()]);
    }

    return list.reverse();
}
let lastWeek = lastweek();
function createSourceData(element) {
    if(ctx){
        removeDataset(ctx);
        }
    data = {"earnings" : [
               	{
               	  "earn": 1576.68,
               	  "date": "2014-05-21"
               	},
               	{
               	  "earn": 1592.29,
               	  "date": "2019-02-15"
               	},
               	{
               	  "earn": 3206.68,
               	  "date": "2016-12-09"
               	},
               	{
               	  "earn": 2746.29,
               	  "date": "2019-01-14"
               	},
               	{
               	  "earn": 895.87,
               	  "date": "2014-09-01"
               	},
               	{
               	  "earn": 1429.15,
               	  "date": "2015-06-02"
               	},
               	{
               	  "earn": 544.25,
               	  "date": "2017-03-09"
               	},
               	{
               	  "earn": 1968.65,
               	  "date": "2015-06-08"
               	},
               	{
               	  "earn": 3071.44,
               	  "date": "2014-05-30"
               	},
               	{
               	  "earn": 2215.85,
               	  "date": "2015-12-10"
               	},
               	{
               	  "earn": 2057.22,
               	  "date": "2017-05-07"
               	},
               	{
               	  "earn": 3071.2,
               	  "date": "2015-07-16"
               	},
               	{
               	  "earn": 573.41,
               	  "date": "2019-01-06"
               	},
               	{
               	  "earn": 530.1,
               	  "date": "2018-03-26"
               	},
               	{
               	  "earn": 553.13,
               	  "date": "2021-10-04"
               	},
               	{
               	  "earn": 448.49,
               	  "date": "2020-02-02"
               	},
               	{
               	  "earn": 999.74,
               	  "date": "2014-09-04"
               	},
               	{
               	  "earn": 2557.52,
               	  "date": "2016-10-26"
               	},
               	{
               	  "earn": 2167.66,
               	  "date": "2017-10-17"
               	},
               	{
               	  "earn": 1365.66,
               	  "date": "2020-10-21"
               	},{
               	  "earn": 1365.66,
               	  "date": "2022-05-20"
               	},{
               	  "earn": 365.66,
               	  "date": "2022-05-19"
               	},{
               	  "earn": 1265.66,
               	  "date": "2022-05-18"
               	},{
               	  "earn": 565.66,
               	  "date": "2022-05-17"
               	}
                 ],
                 "orders" : [
                             	{
                             	  "earn": 1576.68,
                             	  "date": "2014-05-21"
                             	},
                             	{
                             	  "earn": 1592.29,
                             	  "date": "2019-02-15"
                             	},
                             	{
                             	  "earn": 3206.68,
                             	  "date": "2016-12-09"
                             	},
                             	{
                             	  "earn": 2746.29,
                             	  "date": "2019-01-14"
                             	},
                             	{
                             	  "earn": 895.87,
                             	  "date": "2014-09-01"
                             	},
                             	{
                             	  "earn": 1429.15,
                             	  "date": "2015-06-02"
                             	},
                             	{
                             	  "earn": 544.25,
                             	  "date": "2017-03-09"
                             	},
                             	{
                             	  "earn": 1968.65,
                             	  "date": "2015-06-08"
                             	},
                             	{
                             	  "earn": 3071.44,
                             	  "date": "2014-05-30"
                             	},
                             	{
                             	  "earn": 2215.85,
                             	  "date": "2015-12-10"
                             	},
                             	{
                             	  "earn": 2057.22,
                             	  "date": "2017-05-07"
                             	},
                             	{
                             	  "earn": 3071.2,
                             	  "date": "2015-07-16"
                             	},
                             	{
                             	  "earn": 573.41,
                             	  "date": "2019-01-06"
                             	},
                             	{
                             	  "earn": 530.1,
                             	  "date": "2018-03-26"
                             	},
                             	{
                             	  "earn": 553.13,
                             	  "date": "2021-10-04"
                             	},
                             	{
                             	  "earn": 448.49,
                             	  "date": "2020-02-02"
                             	},
                             	{
                             	  "earn": 999.74,
                             	  "date": "2014-09-04"
                             	},
                             	{
                             	  "earn": 2557.52,
                             	  "date": "2016-10-26"
                             	},
                             	{
                             	  "earn": 2167.66,
                             	  "date": "2017-10-17"
                             	},
                             	{
                             	  "earn": 1365.66,
                             	  "date": "2020-10-21"
                             	},{
                             	  "earn": 5.66,
                             	  "date": "2022-05-20"
                             	},{
                             	  "earn": 5.66,
                             	  "date": "2022-05-19"
                             	},{
                             	  "earn": 165.66,
                             	  "date": "2022-05-18"
                             	},{
                             	  "earn": 65.66,
                             	  "date": "2022-05-17"
                             	}]
                               }
    var index = element;
    sorted_data = data[index].sort(sort_objects);
    data = sorted_data.map(({
             "earn": y,
             "date": t,
             ...rest
           }) => ({
             y, t,
             ...rest
           }));
    //Filtering by selected date
    var canvas = document.getElementById("dateTimeChart").getContext("2d");
    /*** Gradient ***/
    var gradient = canvas.createLinearGradient(0, 0, 0, 330);
        gradient.addColorStop(0, 'rgba(220, 129, 255, 0.7)');
        gradient.addColorStop(1, 'rgba(220, 129, 255, 0)');
    /***************/
    data = data.slice(-7);

    document.getElementById("amount").textContent="$ "+Math.round(data.reduce((a, b) => +a + +b.y, 0),2);
    Chart.defaults.LineWithLine = Chart.defaults.line;
    Chart.controllers.LineWithLine = Chart.controllers.line.extend({
        draw: function(ease) {
            Chart.controllers.line.prototype.draw.call(this, ease);

            if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
                var activePoint = this.chart.tooltip._active[0],
                    ctx = this.chart.ctx,
                    x = activePoint.tooltipPosition().x,
                    topY = this.chart.scales['y-axis-0'].top,
                    bottomY = this.chart.scales['y-axis-0'].bottom;

                // draw line
                ctx.save();
                ctx.beginPath();
                ctx.moveTo(x, topY);
                ctx.lineTo(x, bottomY);
                ctx.lineWidth = 2;
                ctx.strokeStyle = '#757575';
                ctx.setLineDash([5,4]);
                ctx.stroke();
                ctx.restore();
            }
        }
    });

    var config_ctx = {
                             type: 'LineWithLine',
                             data: {
                                 labels: lastWeek,
                                 datasets: [
                                 {
                                     backgroundColor: gradient,
                                     borderColor: '#BC6EFB',
                                     data: data
                                 }
                               ]
                             },

                             options: {
                                layout: {
                                     padding: {
                                         // Any unspecified dimensions are assumed to be 0
                                         top: 65
                                     }
                                },
                                tooltips: {
                                      callbacks: {
                                        title: function(tooltipItem, data) {
                                          return data['labels'][tooltipItem[0]['index']];
                                        },
                                        label: function(tooltipItem, data) {
                                          return '$ ' + data['datasets'][0]['data'][tooltipItem['index']].y;
                                        },
                                        afterLabel: function(tooltipItem, data) {
                                          var dataset = data['datasets'][0];
                                          var percent = data['datasets'][0]['data'][tooltipItem['index']].t
                                          return
                                        }
                                      },
                                      backgroundColor: '#FFF',
                                      titleAlign: 'center',
                                      titleFontFamily: 'Gilroy',
                                      titleFontColor: '#000',
                                      bodyFontColor: '#000',
                                      bodyFontSize: 18,
                                      bodyFontFamily: 'Gilroy',
                                      displayColors: false,
                                      yAlign: 'bottom',
                                      xAlign: 'center',
                                    },
                                   legend: {
                                      display: false
                                    },
                                    scales: {

                                        yAxes: [{
                                            ticks: {
                                               display: false,
                                               paddingTop: 20,
                                            },
                                            gridLines: {
                                               color: "black",
                                               display: false,
                                               paddingTop: 20,
                                               drawBorder: true,
                                            },
                                            y: -200,
                                        }],
                                        xAxes: [{
                                            ticks: {
                                               display: true,
                                               padding: 20,
                                               fontFamily:"Gilroy",
                                               fontWeight: 800,
                                               fontColor:'#FFF',
                                            },
                                            gridLines: {
                                               color: "#FFFFFF33",
                                               drawOnChartArea: true,
                                               drawBorder: false,

                                            }
                                        }],

                                    },
                                    responsive: true,
                                    maintainAspectRatio: true
                                },

                      }

var ctx = new Chart(canvas, config_ctx);
picker.on('select', function(){
    var sd = picker.getStartDate().getTime();
    var ed = picker.getEndDate().getTime();
    final_dates = data.filter(d => {var time = new Date(d.t).getTime();
    return (sd < time && time < ed);
    });
    if (final_dates.length > 0 ){
    removeDataset(ctx);
    document.getElementById("timerange").textContent=final_dates[0].t + " - " + final_dates[final_dates.length-1].t;
    document.getElementById("amount").textContent="$ "+Math.round(final_dates.reduce((a, b) => +a + +b.y, 0),2);
    document.getElementById("captionAmount").textContent="Earnings per period";
    addDataset(ctx,"Data", final_dates, gradient, "#BC6EFB", true);
    ctx.update();
    }
    else{
        document.getElementById("amount").textContent="$ ---";
        removeDataset(ctx);
         ctx.update();
    }
});
}
createSourceData('earnings');

function removeDataset(chart) {
   chart.data.datasets = [];
};
function addDataset(chart, name, data, background, border, fill) {
    var newDataset = {
        label: name,
        data: [],
        backgroundColor: background,
        borderColor: border,
        fill: fill
    };
    for (var index = 0; index < data.length; ++index) {
        newDataset.data.push(data[index]);
    }
    let newLabels = data.map(a => a.t);

    chart.data.labels = newLabels;
    data = data;
    chart.data.datasets.push(newDataset);
};

function updateData(data_source) {
    var sd = picker.getStartDate().getTime();
    var ed = picker.getEndDate().getTime();
    final_dates = data[data_source].filter(d => {var time = new Date(d.t).getTime();
    return (sd < time && time < ed);
    });
    removeDataset(ctx);
    addDataset(ctx,"Data", final_dates, gradient, "#BC6EFB", true);
    ctx.update();
}
function changeData(element) {
    createSourceData(element);
}
</script>



</main>
