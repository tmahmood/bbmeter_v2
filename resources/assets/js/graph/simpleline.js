// SimpleLine class starts here

function SimpleLine(){
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
	this.xtext = 'Date';
	this.ytext = 'Percentage';
}

SimpleLine.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

SimpleLine.prototype.addData = function(values) {
	for (var i in values) {
		var val = values[i]
		this.series.push({ name: val.key, data:  val.values });
	}
};

SimpleLine.prototype.draw = function() {
	var me = this;
	var d = {
		title: { text: me.info },
		subtitle: { text: me.subtitle },
		credits: {
			enabled: false,
		},
		xAxis: {
			type: 'datetime',
			title: { text: me.xtext },
			gridLineWidth: 1,
			dateTimeLabelFormats: {
                month: '%b, %Y',
                year: '%Y'
            }
		},
		yAxis: {
			title: { text: me.ytext },
			min: 0,
            gridLineWidth: 1,
		},
		plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b, %Y}: {point.y:.2f}%'
        },
		series: me.series
	}
	$(me.container).highcharts(d);
};

