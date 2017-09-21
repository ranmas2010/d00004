
gapi.analytics.ready(function() {

	/**
	 * Authorize the user immediately if the user has already granted access.
	 * If no access has been created, render an authorize button inside the
	 * element with the ID "embed-api-auth-container".
	 */
	gapi.analytics.auth.authorize({
		container: 'embed-api-auth-container',
		clientid: '953936415016-97gh39cuhgn7tsvpv8mts4bp5l6jf7br.apps.googleusercontent.com'
	});


	/**
	 * Store a set of common DataChart config options since they're shared by
	 * both of the charts we're about to make.
	 */
	var commonConfig = {
		query: {
			metrics: 'ga:sessions',
			dimensions: 'ga:date'
		},
		chart: {
			type: 'LINE',
			options: {
				width: '100%'
			}
		}
	};


	/**
	 * Query params representing the first chart's date range.
	 */
	var dateRange1 = {
		'start-date': '14daysAgo',
		'end-date': '8daysAgo'
	};


	/**
	 * Query params representing the second chart's date range.
	 */
	var dateRange2 = {
		'start-date': '7daysAgo',
		'end-date': 'yesterday'
	};


	/**
	 * Create a new ViewSelector2 instance to be rendered inside of an
	 * element with the id "view-selector-container".
	 */
	var viewSelector = new gapi.analytics.ext.ViewSelector2({
		container: 'view-selector-container',
	});
	viewSelector.execute();

	/**
	 * Create a new DateRangeSelector instance to be rendered inside of an
	 * element with the id "date-range-selector-1-container", set its date range
	 * and then render it to the page.
	 */
	/* var dateRangeSelector1 = new gapi.analytics.ext.DateRangeSelector({
	 container: 'date-range-selector-1-container'
	 })
	 .set(dateRange1)
	 .execute();*/


	/**
	 * Create a new DateRangeSelector instance to be rendered inside of an
	 * element with the id "date-range-selector-2-container", set its date range
	 * and then render it to the page.
	 */
	var dateRangeSelector2 = new gapi.analytics.ext.DateRangeSelector({
		container: 'date-range-selector-2-container'
	})
		.set(dateRange2)
		.execute();

 
	/**
	 * Create a new DataChart instance with the given query parameters
	 * and Google chart options. It will be rendered inside an element
	 * with the id "data-chart-1-container".
	 */
	/* var dataChart1 = new gapi.analytics.googleCharts.DataChart(commonConfig)
	 .set({query: dateRange1})
	 .set({chart: {container: 'data-chart-1-container'}});
	 */

	/**
	 * Create a new DataChart instance with the given query parameters
	 * and Google chart options. It will be rendered inside an element
	 * with the id "data-chart-2-container".
	 */
	var dataChart2 = new gapi.analytics.googleCharts.DataChart(commonConfig)
		.set({query: dateRange2})
		.set({chart: {container: 'data-chart-2-container'}});


	/**
	 * Register a handler to run whenever the user changes the view.
	 * The handler will update both dataCharts as well as updating the title
	 * of the dashboard.
	 */
	viewSelector.on('viewChange', function(data) {
		// dataChart1.set({query: {ids: data.ids}}).execute();

		dataChart2.set({query: {ids: 'ga:16482617'}}).execute();

		/*
		 var title = document.getElementById('view-name');
		 title.innerHTML = data.property.name + ' (' + data.view.name + ')';
		 */
	});


	/**
	 * Register a handler to run whenever the user changes the date range from
	 * the first datepicker. The handler will update the first dataChart
	 * instance as well as change the dashboard subtitle to reflect the range.
	 */
	/*  dateRangeSelector1.on('change', function(data) {
	 dataChart1.set({query: data}).execute();

	 // Update the "from" dates text.
	 var datefield = document.getElementById('from-dates');
	 datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
	 });*/


	/**
	 * Register a handler to run whenever the user changes the date range from
	 * the second datepicker. The handler will update the second dataChart
	 * instance as well as change the dashboard subtitle to reflect the range.
	 */
	dateRangeSelector2.on('change', function(data) {
		dataChart2.set({query: data}).execute();

		// Update the "to" dates text.
/*
		var datefield = document.getElementById('to-dates');
		datefield.innerHTML = data['start-date'] + '&mdash;' + data['end-date'];
		*/
	});



	renderTopBrowsersChart('ga:36551421');//瀏覽器統計


	function renderTopBrowsersChart(ids) {

		query({
			'ids': ids,
			'dimensions': 'ga:browser',
			'metrics': 'ga:pageviews',
			'sort': '-ga:pageviews',
			'max-results': 5
		})
			.then(function(response) {

				var data = [];
				var colors = ['#4D5360','#949FB1','#D4CCC5','#E2EAE9','#F7464A'];

				response.rows.forEach(function(row, i) {
					data.push({ value: +row[1], color: colors[i], label: row[0] });
				});

				/*new Chart(makeCanvas('chart-3-container')).Doughnut(data);
				generateLegend('legend-3-container', data);*/
			});
	}




	function query(params) {
		return new Promise(function(resolve, reject) {
			var data = new gapi.analytics.report.Data({query: params});
			data.once('success', function(response) { resolve(response); })
				.once('error', function(response) { reject(response); })
				.execute();
		});
	}


	/**
	 * Create a new canvas inside the specified element. Set it to be the width
	 * and height of its container.
	 * @param {string} id The id attribute of the element to host the canvas.
	 * @return {RenderingContext} The 2D canvas context.
	 */
	function makeCanvas(id) {

		console.log(id);
		var container = document.getElementById(id);
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');

		container.innerHTML = '';
		canvas.width = container.offsetWidth;
		canvas.height = container.offsetHeight;
		container.appendChild(canvas);

		return ctx;
	}


	/**
	 * Create a visual legend inside the specified element based off of a
	 * Chart.js dataset.
	 * @param {string} id The id attribute of the element to host the legend.
	 * @param {Array.<Object>} items A list of labels and colors for the legend.
	 */
	function generateLegend(id, items) {
		var legend = document.getElementById(id);
		legend.innerHTML = items.map(function(item) {
			var color = item.color || item.fillColor;
			var label = item.label;
			return '<li><i style="background:' + color + '"></i>' + label + '</li>';
		}).join('');
	}

	// Set some global Chart.js defaults.
	Chart.defaults.global.animationSteps = 60;
	Chart.defaults.global.animationEasing = 'easeInOutQuart';
	Chart.defaults.global.responsive = true;
	Chart.defaults.global.maintainAspectRatio = false;


	var mainChart = new gapi.analytics.googleCharts.DataChart({
		query: {
			'dimensions': 'ga:browser',
			'metrics': 'ga:sessions',
			'sort': '-ga:sessions',
			'max-results': '6'
		},
		chart: {
			type: 'TABLE',
			container: 'main-chart-container',
			options: {
				width: '100%'
			}
		}
	});

	/**
	 * Create a timeline chart showing sessions over time for the browser the
	 * user selected in the main chart.
	 */
	var breakdownChart = new gapi.analytics.googleCharts.DataChart({
		query: {
			'dimensions': 'ga:date',
			'metrics': 'ga:sessions',
			'start-date': '7daysAgo',
			'end-date': 'yesterday'
		},
		chart: {
			type: 'LINE',
			container: 'breakdown-chart-container',
			options: {
				width: '100%'
			}
		}
	});


	/**
	 * Store a refernce to the row click listener variable so it can be
	 * removed later to prevent leaking memory when the chart instance is
	 * replaced.
	 */
	var mainChartRowClickListener;


	/**
	 * Update both charts whenever the selected view changes.
	 */
	viewSelector.on('change', function(ids) {
		var options = {query: {ids: 'ga:36551421'}};

		// Clean up any event listeners registered on the main chart before
		// rendering a new one.
		if (mainChartRowClickListener) {
			google.visualization.events.removeListener(mainChartRowClickListener);
		}

		mainChart.set(options).execute();
		breakdownChart.set(options);

		// Only render the breakdown chart if a browser filter has been set.
		if (breakdownChart.get().query.filters) breakdownChart.execute();
	});


	/**
	 * Each time the main chart is rendered, add an event listener to it so
	 * that when the user clicks on a row, the line chart is updated with
	 * the data from the browser in the clicked row.
	 */
	mainChart.on('success', function(response) {

		var chart = response.chart;
		var dataTable = response.dataTable;

		// Store a reference to this listener so it can be cleaned up later.
		mainChartRowClickListener = google.visualization.events
			.addListener(chart, 'select', function(event) {

				// When you unselect a row, the "select" event still fires
				// but the selection is empty. Ignore that case.
				if (!chart.getSelection().length) return;

				var row =  chart.getSelection()[0].row;
				var browser =  dataTable.getValue(row, 0);
				var options = {
					query: {
						filters: 'ga:browser==' + browser
					},
					chart: {
						options: {
							title: browser
						}
					}
				};

				breakdownChart.set(options).execute();
			});
	});



});

