function GraphCore() {
	this.colordict = {};
}

var graphcore = new GraphCore();

GraphCore.prototype.drawChart = function(cfg) {
	  $(cfg.container).append('<div id="highchart_graph"></div>');
	  var gp = new window[cfg.type]();
	  gp.set('container', '#highchart_graph');
	  gp.title = cfg.key;
	  gp.info = cfg.info;
	  gp.explanation = cfg.explanation;
	  gp.addData(cfg.values);
	  gp.draw();
	  $('#page-header strong').empty().append(gp.title);
	  $('#site-menu h4').empty().append(gp.explanation.heading);
	  $('#site-menu p').empty().append(gp.explanation.text);
};

