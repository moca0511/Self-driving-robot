<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
	<meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
	<script src="../components/loader.js"></script>
	<script src="../lib/onsenui/js/onsenui.min.js"></script>
	<script src="../js/map.js"></script>
	

	<link rel="stylesheet" href="../components/loader.css">
	<link rel="stylesheet" href="../lib/onsenui/css/onsenui.css">
	<link rel="stylesheet" href="../lib/onsenui/css/onsen-css-components.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="manifest" href="../manifest.json">

	<script async src="https://cdn.jsdelivr.net/npm/pwacompat@2.0.7/pwacompat.min.js"></script>

	<script>
		ons.ready(function() {
		console.log("Onsen UI is ready!");
		});

		if (ons.platform.isIPhoneX()) {
		document.documentElement.setAttribute('onsflag-iphonex-portrait', '');
		document.documentElement.setAttribute('onsflag-iphonex-landscape', '');
		}
	</script>

	<style>

		#vision_console {
			height: 100%;
			width: 50%;
			float : left;
			background:black;
			color:white;
			/* display: flex;
			text-align: center;
			align-items: center;
			justify-content: center; */
		}
		#vision p{
			margin: 0;
		}
		#vision img{
			width: 100%;
			height: auto;
			/* object-fit: cover; */
		}

		#map {
			height: 100%;
			width: 50%;
			float : right;
			font-size:200%;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center
		}
		#map p{
		margin: 0;
		}
			
	</style>

	<script>
		if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('../service-worker.js').then(function (registration) {
			console.log('ServiceWorker registration successful with scope: ', registration.scope);
		}).catch(function (err) {
			console.log('ServiceWorker registration failed: ', err);
		});
		}
	</script>
	<script>
		function stop_rover(){
			console.log('POST');
			const ymdField = document.getElementById('ymd-id');
			const timeField = document.getElementById('time-id');
			// const sOrAField = document.getElementById('start_arrival-id');
			const stateField = document.getElementById('state-id');
			ymdField.value = "0000/00/00";
			timeField.value = "00:00:00";
			// sOrAField.value = "start";
			// stateField.value = "stop_rover";
			document.frmMain.submit();
  			return false;
		}
	</script>

	</head>
	<body>
		<form action="php/log.php" method="POST" name="frmMain" target="sendPhoto">
			<input type="hidden" name="state" id="state-id" value="stop_rover">
			<input type="hidden" name="ymd" id="ymd-id" value="0000/00/00">
			<input type="hidden" name="time" id="time-id" value="00:00:00">
			<!-- <input type="hidden" name="start_arrival" id="start_arrival-id" value="start"> -->
		</form>
		<ons-page>
			<ons-toolbar>
				<div class="center" onmouseup="location.href='./main.php'">SelfDrivingRobot</div>
				<div class="right">
					<ons-toolbar-button>
						<ons-icon icon="fa-gamepad" onclick="location.href='./manual.php'"></ons-icon>
					</ons-toolbar-button>
					<ons-toolbar-button>
						<ons-icon icon="fa-map-marker-alt"></ons-icon>
					</ons-toolbar-button>
					<ons-toolbar-button>
						<ons-icon icon="fa-history"></ons-icon>
					</ons-toolbar-button>
						<ons-toolbar-button onclick="stop_rover();">
							<ons-icon style="color: red;" icon="fa-ban"></ons-icon>
						</ons-toolbar-button>
					
				</div>
			</ons-toolbar>
			
			<div id="vision_console">
				<div id="vision">
					<img src="http://192.168.1.15:8080/?action=stream"  altonerror="this.onerror = null; this.src='';">
					<!-- <ons-icon icon="fa-eye-slash" size="2x"></ons-icon>
					<p>vision error</p> -->
				</div>
				<div id="console"><p>console</p></div>
			</div>
			<div id="map">
				<iframe id="googlemap" src="./map.php" style="width:100%;height:100%;border:0px;"></iframe>
			</div>
			
		</ons-page>
		
	<iframe name="sendPhoto" style="width:0px;height:0px;border:0px;"></iframe>
	</body>
</html>