function Main(opts) {
	this.opts = opts == null ?  opts : {};
}

Main.prototype.objectToArray = function(obj) {
	return $.map(obj, function(value, index) {
		return [value];
	});
};

Main.prototype.spliceSlice = function(str, index, count, add) {
  return str.slice(0, index) + (add || "") + str.slice(index + count);
}

var main = new Main();

$(function(){
	$('#popover_link_aboutdi').popover({
		placement: 'auto',
		html: true,
	})

	$('#popover_link_methodology').popover({
		placement: 'auto',
		html: true,
	})


});

// google analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-55074319-1', 'auto');
ga('send', 'pageview');

// google analytics
