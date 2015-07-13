
function GroupedMultiBar() {
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
	this.stacked = false;
	this.direction = "";
}

GroupedMultiBar.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

GroupedMultiBar.prototype.addData = function(d) {

	this.categories = d.categories;
	this.series = d.data;
};

GroupedMultiBar.prototype.draw = function() {

	var me = this;
	var d = {
        chart: { type: 'column' },
        title: { text: me.info },
		credits: {
			enabled: false,
		},
        xAxis: {
            categories: me.categories
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Percentage'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}%</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
            }
        },
        series: me.series
	};
	if (this.stacked == true) {
		if (this.direction == "V") {
			d.plotOptions.column.stacking = 'percent';
		} else {
			d.plotOptions.series = {};
			d.plotOptions.series.stacking = 'percent';
			d.chart.type = 'bar';
		}
	}
	console.log(d);
    $(me.container).highcharts(d);
};

function VStackedBar() {
	var gp = new GroupedMultiBar();
	gp.stacked = true;
	gp.direction = "V";
	return gp;
}

function HStackedBar() {
	var gp = new GroupedMultiBar();
	gp.stacked = true;
	gp.direction = "H";
	return gp;
}
