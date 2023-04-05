var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var millisecondsLabel = document.getElementById("milliseconds");
var totalMilliseconds = 0;
var stopwatchInterval;

function pad(number) {
	if (number < 10) {
		return "0" + number;
	}
	return number;
}

function updateTime() {
	totalMilliseconds += 10;
	var minutes = Math.floor((totalMilliseconds / 1000 / 60) % 60);
	var seconds = Math.floor((totalMilliseconds / 1000) % 60);
	var milliseconds = totalMilliseconds % 1000 / 10;
	minutesLabel.innerHTML = pad(minutes);
	secondsLabel.innerHTML = pad(seconds);
	millisecondsLabel.innerHTML = pad(milliseconds);
}

document.getElementById("start").addEventListener("click", function() {
	stopwatchInterval = setInterval(updateTime, 10);
	document.getElementById("start").disabled = true;
	document.getElementById("stop").disabled = false;
});

document.getElementById("stop").addEventListener("click", function() {
	clearInterval(stopwatchInterval);
	document.getElementById("stop").disabled = true;
	document.getElementById("start").disabled = false;
});
