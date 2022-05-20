<link rel="stylesheet" href="/assets/min/admin.css">
<!-- <link rel="stylesheet" href="/assets/min/calendar.css"> -->


<main class="admin-site">
	<div class="admin-details-wrap">
		<div class="admin-hello">
		    <div class="hello-text">
        	    <h5 class="heading">Hi, Lucky Luke!</h2>
        	    <p>Welcome! Manage your tasks and work here</p>
        	</div>
        </div>
        <div class="navigation">
            <h3>Dashboard</h3>
            <div class="chart-select">
                <div class="active" onclick="changeData('earnings')">Earned Amount</div>
                <div onclick="changeData('orders')">Amount of Sales</div>
                <div onclick="changeData('signups')">Amount of Signups</div>
                <div onclick="changeData('users')">Daily Active Users</div>
                <div onclick="changeData('captcha')">Captcha Requests</div>
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
            <canvas id="dateTimeChart" width="400" height="200"></canvas>
		</div>
	</div>
	<div class="sidebar">
	    <div class="controls">
	        <div class="bell"><img src="../assets/img/bell.svg" width="20"/></div>
	        <div class="admin"><img src="../assets/img/Avatar.svg" width=32/>Admin</div>
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
        "assets/min/calendar.css"
    ],
    zIndex: 10,
    plugins: [
        "RangePlugin"
    ]
});
function sort_objects(a, b) {
    return new Date(a["date"]).getTime() - new Date(b["date"]).getTime();
}
var data = {"earnings" : [
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
             ],"orders" : [
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

var sorted_data;
function createSourceData(element) {
    sorted_data = data[element].sort(sort_objects);
}
createSourceData('earnings');
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
var config_ctx = {
                         type: 'line',
                         data: {
                             labels:  data.slice(-7).map(a => a.t),
                             datasets: [
                             {
                                 backgroundColor: gradient,
                                 borderColor: '#BC6EFB',
                                 data: data
                             }
                           ]
                         },

                         options: {
                            legend: {
                               display: false
                             },
                             scales: {
                                 yAxes: [{
                                     ticks: {
                                        display: false
                                     },
                                     gridLines: {
                                        fontColor: "#CCC",
                                        display: false
                                     }
                                 }],
                                 xAxes: [{
                                     gridLines: {
                                        color: "#FFFFFF33",
                                        display: true
                                     }
                                 }],

                             },
                             responsive: true,
                             maintainAspectRatio: false
                         }
                  }

var ctx = new Chart(canvas, config_ctx);

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
picker.on('select', function(){
    var sd = picker.getStartDate().getTime();
    var ed = picker.getEndDate().getTime();
    final_dates = data.filter(d => {var time = new Date(d.t).getTime();
    return (sd < time && time < ed);
    });
    removeDataset(ctx);
    document.getElementById("timerange").textContent=final_dates[0].t + " - " + final_dates[final_dates.length-1].t;
    document.getElementById("amount").textContent="$ "+Math.round(final_dates.reduce((a, b) => +a + +b.y, 0),2);
    document.getElementById("captionAmount").textContent="Earnings per period";
    addDataset(ctx,"Data", final_dates, gradient, "#BC6EFB", true);
    ctx.update();
});
</script>



</main>
