options = {
 series: {
  pie: {
  	innerRadius: 0.5,
  	show: true,
  	label: {
  		show: true,
  		formatter: function (label, series) {
  			console.log(series.data);
  			return '<div style="font-size:8pt;text-align:center;padding:2px; color: ' + series.color +';">' + label + '<br/>' + series.data[0][1] + '</div>';
		},
	}
  }
 },
};