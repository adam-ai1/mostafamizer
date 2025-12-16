"use strict";
const html = document.documentElement;
// Helper to generate dates
function rangeDays(n) {
	const out = [];
	for (let i = n - 1; i >= 0; i--) {
		const d = new Date();
		d.setDate(d.getDate() - i);
		out.push(
			`${d.getFullYear()}-${(d.getMonth() + 1).toString().padStart(2, "0")}-${d
				.getDate()
				.toString()
				.padStart(2, "0")}`
		);
	}
	return out;
}

// Get current theme colors
function getThemeColors() {
	const isDark = html.classList.contains("dark");
	return {
		gridColor: isDark ? "#474746" : "#e2e8f0",
		textColor: isDark ? "#898989" : "#64748b",
		bgColor: isDark ? "#3a3a39" : "#ffffff",
	};
}

// Campaign Line Chart
let lineChart;
let lineRequestController;

function createLineChart(days = 30) {
	const colors = getThemeColors();

	if (lineRequestController) {
		lineRequestController.abort();
	}

	const controller = new AbortController();
	lineRequestController = controller;

	const { signal } = controller;

	
	// Fetch campaign performance data
	fetch(`${SITE_URL}/user/marketing-bot/campaign-performance/${days}`, { signal })
		.then(response => response.json())
		.then(data => {

			if (lineRequestController !== controller) {
               return;
           	}

			// Generate colors for each channel
			const channelColors = generateColors(data.channels.length, data.channels);
			const strokeColors = channelColors.map(color => color);
			
			// Create series for each channel
			const series = data.channels.map((channel, index) => {
				return {
					name: channel.charAt(0).toUpperCase() + channel.slice(1), // Capitalize channel name
					data: data.channelData[channel]
				};
			});
			
			const lineOptions = {
				chart: {
					type: "line",
					height: 320,
					toolbar: { show: false },
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				stroke: { curve: "smooth", width: 4 },
				series: series,
				xaxis: {
					categories: data.dates,
					labels: {
						rotate: -45,
						style: { colors: colors.textColor },
					},
				},
				yaxis: {
					labels: {
						formatter: (v) => Math.round(v),
						style: { colors: colors.textColor },
					},
				},
				grid: { borderColor: colors.gridColor },
				markers: {
					size: 6,
					strokeWidth: 3,
					strokeColors: strokeColors,
				},
				colors: channelColors,
				legend: {
					labels: { colors: colors.textColor },
				},
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (lineChart) {
				lineChart.destroy();
			}
			lineChart = new ApexCharts(
				document.querySelector("#campaignLine"),
				lineOptions
			);
			lineChart.render();
			lineRequestController = null;
		})
		.catch(error => {
			if (error.name === "AbortError") {
				return;
			}
			
			if (lineRequestController !== controller) {
				return;
			}
           lineRequestController = null;
			// Fallback to empty data if fetch fails
			const emptyData = {
				dates: rangeDays(days),
				channels: ["whatsapp", "telegram"],
				channelData: {
					whatsapp: Array(days).fill(0),
					telegram: Array(days).fill(0)
				}
			};
			renderLineChart(emptyData);
		});
}

// Helper function to generate colors for dynamic channels
function generateColors(count, channels = []) {
	// Default colors for common channels
	const defaultColors = {
		"whatsapp": "#22c55e",
		"telegram": "#3b82f6",
		"email": "#f59e0b",
		"instagram": "#d946ef",
		"facebook": "#1877f2"
	};
	
	// Predefined color palette for additional channels
	const colorPalette = [
		"#ef4444", "#f97316", "#eab308", "#84cc16", "#06b6d4", 
		"#0ea5e9", "#6366f1", "#8b5cf6", "#a855f7", "#ec4899"
	];
	
	const colors = [];
	
	// For each channel in the data
	for (let i = 0; i < count; i++) {
		const channel = channels[i];
		// If we have a default color for this channel, use it
		if (channel && defaultColors[channel]) {
			colors.push(defaultColors[channel]);
		} else {
			// Otherwise, use a color from our palette
			colors.push(colorPalette[i % colorPalette.length]);
		}
	}
	
	return colors;
}

// Function to render line chart with empty data
function renderLineChart(data) {
	const colors = getThemeColors();
	const channelColors = generateColors(data.channels.length, data.channels);
	
	const series = data.channels.map((channel, index) => {
		return {
			name: channel.charAt(0).toUpperCase() + channel.slice(1),
			data: data.channelData[channel]
		};
	});
	
	const lineOptions = {
		chart: {
			type: "line",
			height: 320,
			toolbar: { show: false },
			background: colors.bgColor,
			fontFamily: "Inter",
		},
		stroke: { curve: "smooth", width: 4 },
		series: series,
		xaxis: {
			categories: data.dates,
			labels: {
				rotate: -45,
				style: { colors: colors.textColor },
			},
		},
		yaxis: {
			labels: {
				formatter: (v) => Math.round(v),
				style: { colors: colors.textColor },
			},
		},
		grid: { borderColor: colors.gridColor },
		markers: {
			size: 6,
			strokeWidth: 3,
			strokeColors: channelColors,
		},
		colors: channelColors,
		legend: {
			labels: { colors: colors.textColor },
		},
		tooltip: {
			theme: html.classList.contains("dark") ? "dark" : "light",
		},
	};

	if (lineChart) {
		lineChart.destroy();
	}
	lineChart = new ApexCharts(
		document.querySelector("#campaignLine"),
		lineOptions
	);
	lineChart.render();
}

// Donut Chart
let donutChart;
function createDonutChart() {
	const colors = getThemeColors();
	
	// Fetch channel distribution data
	fetch(`${SITE_URL}/user/marketing-bot/channel-distribution`)
		.then(response => response.json())
		.then(data => {
			// Generate dynamic series and labels from all available channels
			const channels = data.channels || [];
			const distribution = data.distribution || {};
			
			// Calculate total count
			const total = Object.values(distribution).reduce((sum, count) => sum + count, 0);
			
			// Calculate percentages for each channel
			const series = [];
			const labels = [];
			
			channels.forEach(channel => {
				const count = distribution[channel] || 0;
				const percentage = total > 0 ? (count / total) * 100 : 0;
				series.push(percentage);
				// Capitalize first letter of channel name
				const capitalizedChannel = channel.charAt(0).toUpperCase() + channel.slice(1).toLowerCase();
				labels.push(capitalizedChannel);
			});
			
			// Generate dynamic colors for each channel (pass original channel names for color mapping)
			const dynamicColors = generateColors(channels.length, channels);
			
			const donutOptions = {
				chart: {
					type: "donut",
					height: 320,
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				series: series,
				labels: labels,
				legend: {
					position: "bottom",
					labels: { colors: colors.textColor },
				},
				colors: dynamicColors,
				dataLabels: {
					formatter: (val) => `${val.toFixed(1)}%`,
					style: { fontSize: "14px", fontWeight: "600" },
				},
				plotOptions: {
					pie: {
						donut: {
							size: "70%",
						},
					},
				},
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (donutChart) {
				donutChart.destroy();
			}
			donutChart = new ApexCharts(
				document.querySelector("#channelDonut"),
				donutOptions
			);
			donutChart.render();
		})
		.catch(error => {
			// Fallback to empty data if fetch fails
			const donutOptions = {
				chart: {
					type: "donut",
					height: 320,
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				series: [50, 50],
				labels: ["WhatsApp", "Telegram"],
				legend: {
					position: "bottom",
					labels: { colors: colors.textColor },
				},
				colors: ["#22c55e", "#3b82f6"],
				dataLabels: {
					formatter: (val) => `${val.toFixed(1)}%`,
					style: { fontSize: "14px", fontWeight: "600" },
				},
				plotOptions: {
					pie: {
						donut: {
							size: "70%",
						},
					},
				},
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (donutChart) {
				donutChart.destroy();
			}
			donutChart = new ApexCharts(
				document.querySelector("#channelDonut"),
				donutOptions
			);
			donutChart.render();
		});
}

// Area Chart
let areaChart;
function createAreaChart() {
	const colors = getThemeColors();
	
	// Fetch contact growth data
	fetch(`${SITE_URL}/user/marketing-bot/contact-growth`)
		.then(response => response.json())
		.then(data => {
			const areaOptions = {
				chart: {
					type: "area",
					height: 320,
					toolbar: { show: false },
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				stroke: { curve: "smooth", width: 3 },
				dataLabels: { enabled: false },
				series: [
					{
						name: "New Contacts",
						data: data.counts,
					},
				],
				xaxis: {
					categories: data.months,
					labels: { style: { colors: colors.textColor } },
				},
				yaxis: {
					labels: { style: { colors: colors.textColor } },
				},
				colors: ["#a26ef6"],
				fill: {
					type: "gradient",
					gradient: {
						opacityFrom: 0.4,
						opacityTo: 0.1,
						colorStops: [
							{ offset: 0, color: "#a26ef6", opacity: 0.4 },
							{ offset: 100, color: "#763cd4", opacity: 0.1 },
						],
					},
				},
				grid: { borderColor: colors.gridColor },
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (areaChart) {
				areaChart.destroy();
			}
			areaChart = new ApexCharts(
				document.querySelector("#contactsArea"),
				areaOptions
			);
			areaChart.render();
		})
		.catch(error => {
			// Fallback to dummy data if fetch fails
			const areaOptions = {
				chart: {
					type: "area",
					height: 320,
					toolbar: { show: false },
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				stroke: { curve: "smooth", width: 3 },
				dataLabels: { enabled: false },
				series: [
					{
						name: "New Contacts",
						data: [20, 25, 22, 30, 28, 34, 40, 37, 45, 43, 50, 48],
					},
				],
				xaxis: {
					categories: [
						"Jan", "Feb", "Mar", "Apr", "May", "Jun", 
						"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
					],
					labels: { style: { colors: colors.textColor } },
				},
				yaxis: {
					labels: { style: { colors: colors.textColor } },
				},
				colors: ["#a26ef6"],
				fill: {
					type: "gradient",
					gradient: {
						opacityFrom: 0.4,
						opacityTo: 0.1,
						colorStops: [
							{ offset: 0, color: "#a26ef6", opacity: 0.4 },
							{ offset: 100, color: "#763cd4", opacity: 0.1 },
						],
					},
				},
				grid: { borderColor: colors.gridColor },
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (areaChart) {
				areaChart.destroy();
			}
			areaChart = new ApexCharts(
				document.querySelector("#contactsArea"),
				areaOptions
			);
			areaChart.render();
		});
}

// Bar Chart
let barChart;
function createBarChart() {
	const colors = getThemeColors();
	
	// Fetch conversion data
	fetch(`${SITE_URL}/user/marketing-bot/conversions`)
		.then(response => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.json();
		})
		.then(data => {

			// Get all channels and their conversion data
			const channels = data.channels || [];
			const conversions = data.conversions || {};
			
			// Create data array for the chart
			const seriesData = [];
			const categories = [];
			const originalChannels = []; // Keep track of original channel names for color mapping
			
			// Process each channel and capitalize first letter, exclude channels with 0 values
			channels.forEach((channel, index) => {
				if (channel) { // Only add non-empty channels
					const count = conversions[channel] || 0;
					
					// Only include channels with count > 0
					if (count > 0) {
						// Capitalize first letter of channel name
						const capitalizedChannel = channel.charAt(0).toUpperCase() + channel.slice(1).toLowerCase();
						categories.push(capitalizedChannel);
						seriesData.push(count);
						originalChannels.push(channel); // Store original channel name for color mapping
					} else {
					}
				}
			});
			

			// Generate dynamic colors for each channel (pass original channel names for color mapping)
			const dynamicColors = generateColors(categories.length, originalChannels);
			
			const barOptions = {
				chart: {
					type: "bar",
					height: 320,
					toolbar: { show: false },
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				plotOptions: {
					bar: {
						borderRadius: 8,
						columnWidth: "60%",
						distributed: true,
					},
				},
				series: [{ 
					name: "Conversions", 
					data: seriesData
				}],
				xaxis: {
					categories: categories,
					labels: { 
						style: { colors: colors.textColor },
						rotate: -45,
						trim: false
					},
				},
				yaxis: {
					labels: { style: { colors: colors.textColor } },
				},
				colors: dynamicColors,
				grid: { borderColor: colors.gridColor },
				legend: { show: false },
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (barChart) {
				barChart.destroy();
			}
			barChart = new ApexCharts(
				document.querySelector("#conversionBar"),
				barOptions
			);
			barChart.render();
		})
		.catch(error => {
			// Fallback to dummy data if fetch fails
			const barOptions = {
				chart: {
					type: "bar",
					height: 320,
					toolbar: { show: false },
					background: colors.bgColor,
					fontFamily: "Inter",
				},
				plotOptions: {
					bar: {
						borderRadius: 8,
						columnWidth: "60%",
						distributed: true,
					},
				},
				series: [{ 
					name: "Conversions", 
					data: [5, 3, 2] 
				}],
				xaxis: {
					categories: ["WhatsApp", "Telegram", "Email"],
					labels: { style: { colors: colors.textColor } },
				},
				yaxis: {
					labels: { style: { colors: colors.textColor } },
				},
				colors: ["#22c55e", "#3b82f6", "#f59e0b"],
				grid: { borderColor: colors.gridColor },
				legend: { show: false },
				tooltip: {
					theme: html.classList.contains("dark") ? "dark" : "light",
				},
			};

			if (barChart) {
				barChart.destroy();
			}
			barChart = new ApexCharts(
				document.querySelector("#conversionBar"),
				barOptions
			);
			barChart.render();
		});
}

// Initialize all charts
function initCharts() {
	createLineChart(30);
	createDonutChart();
	createAreaChart();
	createBarChart();
}

// Update chart themes when dark mode toggles
function updateChartThemes() {
	setTimeout(() => {
		initCharts();
	}, 100);
}

// Initialize on load
document.addEventListener("DOMContentLoaded", initCharts);

// Range selector functionality
document.getElementById("rangeSelect").addEventListener("change", (e) => {
	const days = parseInt(e.target.value, 10);
	createLineChart(days);
});

// Skeleton Loading Logic
document.addEventListener('DOMContentLoaded', function() {
	// Function to hide ALL skeletons and show content synchronously
	function hideAllSkeletons() {
		// Hide KPI cards skeleton and show content
		const kpiSkeleton = document.querySelectorAll('.kpi-cards-skeleton');
		const kpiContent = document.querySelectorAll('.kpi-cards-content');
		kpiSkeleton.forEach(skeleton => skeleton.classList.add('hidden'));
		kpiContent.forEach(content => content.classList.remove('hidden'));

		// Hide charts skeleton and show content
		const chartsSkeleton = document.querySelectorAll('.charts-skeleton');
		const chartsContent = document.querySelectorAll('.charts-content');
		chartsSkeleton.forEach(skeleton => skeleton.classList.add('hidden'));
		chartsContent.forEach(content => content.classList.remove('hidden'));

		// Hide second charts skeleton and show content
		const secondChartsSkeleton = document.querySelectorAll('.second-charts-skeleton');
		const secondChartsContent = document.querySelectorAll('.second-charts-content');
		secondChartsSkeleton.forEach(skeleton => skeleton.classList.add('hidden'));
		secondChartsContent.forEach(content => content.classList.remove('hidden'));

		// Hide table skeleton and show content
		const tableSkeleton = document.querySelector('.table-skeleton');
		const tableContent = document.querySelector('.table-content');
		if (tableSkeleton && tableContent) {
			tableSkeleton.classList.add('hidden');
			tableContent.classList.remove('hidden');
		}
	}

	// Use MutationObserver to detect when all charts are loaded, then hide all skeletons at once
	const chartContainers = ['#campaignLine', '#channelDonut', '#contactsArea', '#conversionBar'];
	let loadedCharts = 0;

	chartContainers.forEach(selector => {
		const container = document.querySelector(selector);
		if (container) {
			const observer = new MutationObserver((mutations) => {
				mutations.forEach((mutation) => {
					if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
						// Chart content has been added
						loadedCharts++;
						if (loadedCharts >= chartContainers.length) {
							// All charts loaded - hide all skeletons synchronously
							setTimeout(hideAllSkeletons, 200);
						}
						observer.disconnect(); // Stop observing this container
					}
				});
			});

			observer.observe(container, { childList: true, subtree: true });
		}
	});

	// Fallback: hide all skeletons after unified timeout (in case observer fails)
	setTimeout(hideAllSkeletons, 2000);
});