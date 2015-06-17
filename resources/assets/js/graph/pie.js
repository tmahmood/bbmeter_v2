
function Pie() {
	this.container = null;
	this.title = null;
	this.subtitle = null;
	this.series = [];
}

Pie.prototype.set = function(field, val) {
	this[field] = val;
	return this;
};

Pie.prototype.addData = function(values) {
	for (var i in values) {
		var val = values[i]
		this.series.push([ val.label, val.value * 1 ]);
	}
};

Pie.prototype.draw = function() {
	var me = this;
    $(me.container).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: { text: me.info },
		credits: {
			enabled: false,
		},
        tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: me.title,
            data: me.series
		}]
    });
};
