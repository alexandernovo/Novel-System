(Chart.defaults.global.defaultFontFamily = "Nunito"),
	'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";
Chart.defaults.global.defaultFontSize = 18;

// all projects
var all = document.getElementById("projects-all-status");
var myPieChart = new Chart(all, {
	type: "pie",
	data: {
		labels: ["Pending", "Ongoing", "Finished"],
		datasets: [
			{
				data: [all_pending, all_ongoing, all_finished],
				backgroundColor: [
					"#00A5E3",
					"#8DD7BF",
					"#FF96C5",
					"#FF5768",
					"#FFBF65",
				],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: true,
			caretPadding: 10,
		},
		legend: {
			display: true,
			position: "left",
		},
	},
});
