setInterval(function(){ 
    var seconds = (parseInt(document.getElementsByTagName('span')[0].innerText)*60) + parseInt(document.getElementsByTagName('span')[1].innerText);
	if(seconds == 0) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var ground = JSON.parse(this.responseText);
				document.title = document.title.replace(document.getElementsByTagName("h1")[0].innerText,ground.events)
				document.getElementsByTagName("h1")[0].innerText = ground.events;
				document.getElementsByTagName('h3')[0].innerText = ground.stamp;
				var date = new Date();
				var next = ground.next - (date.getMinutes()*60) - date.getSeconds();
				document.getElementsByTagName("span")[0].innerText = Math.floor(next / 60);
				document.getElementsByTagName("span")[1].innerText = next - (Math.floor(next / 60)*60);
			}
		};
		xhttp.open("GET", "clockgears.php", true);
		xhttp.send();
	} else {
		seconds--;
		document.getElementsByTagName('span')[0].innerText = Math.floor(seconds/60);
		document.getElementsByTagName('span')[1].innerText = seconds - (Math.floor(seconds/60)*60);
		if(document.getElementsByTagName('span')[1].innerText.length==1) document.getElementsByTagName('span')[1].innerText = "0" + document.getElementsByTagName('span')[1].innerText
	}
}, 1000);
