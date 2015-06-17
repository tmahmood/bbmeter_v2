
function DiscretBar() {
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
}

DiscretBar.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

DiscretBar.prototype.addData = function(values) {
	for (var i in values) {
		var val = values[i]
		this.series.push({ name: val.label, y: val.value * 1 });
	}
};

DiscretBar.prototype.draw = function() {
	var me = this;

    $(me.container).highcharts({
        chart: { type: 'column' },
        title: { text: me.info },
        xAxis: { type: 'category' },
        yAxis: { min: 0, title: { text: 'Percent' } },
		legend: { enabled: false },
		credits: {
			enabled: false,
		},
	    tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:.1f}%'
				}
			}
		},
        series: [{
			name: me.title,
            colorByPoint: true,
			data: me.series
		}]
    });
};

