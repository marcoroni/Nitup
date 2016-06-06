<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name=viewport content='width=700'>
	<title> Games4U </title>
	<link rel="stylesheet" type="text/css" href="/css/Website.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script type='text/javascript' src='/js/hovers.js'></script>
</head>
<body background="/images/night.png">
	<header>
		<h1 class="titel">
			<a href="Website.html"><img src="/images/Logo.png" width="200" height="100" /></a>
		</h1>
		<div class ="nav">
			<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/games">Games</a></li>
					@if(!isset($user))
						<li><a href="/register">Registreren</a></li>
						<li><a href="/login">Login</a></li>
					@else
						<li><a href="/logout">uitloggen</a></li>
						<li><a href="/winkelwagen">Bestellingen</a></li>
						@if($user->rank == 'admin')
							<li><a href="/product/toevoegen">nieuw product</a></li>
						@endif
					@endif
					<li><a href="/contact">Contact</a></li>
				
			</ul>
		</div>
	</header>
	@yield($section)
</body>
</html>