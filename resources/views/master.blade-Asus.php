@extends('dashboard')

@section('home')
	<div class="voorgrond">
		@if(count($errors) >= 1)
			<p style="color:red;">{{ $errors->first() }}</p>
		@endif
		<h1>
			Welkom op de website van Games4U.
		</h1>
		<p>
			Wij verkopen retro games voor meerdere spelcomputers.</br>
			Games4U is een bedrijf dat retro games verkoopt. Wij verkopen de beste retro games, die u allen herinnert uit uw kindertijd. </br>
		</p>

		<div class="plaatjes">
			<h1 class="games">
				Populaire games
			</h1>
			<div class = "games">
				<ul class="games">
					<li>
						<a href="/mario" target = "_blank"><img class="plaatje" src="images/mario.png" width="136" height="136" border /></a>
					</li>
					<li>
						<a href="/tetris" target = "_blank"><img class="plaatje" src="images/Tetris.png" width="136" height="136" border /></a>
					</li>
					<li>
						<a href="/pacman" target = "_blank"><img class="plaatje" src="images/pacman.png" width="136" height="136" border /></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
@endsection
@section('login')
	<div class = "voorgrond">
		<h2>Login</h2>
		@if(count($errors) >= 1)
			<p style="color:red;">{{ $errors->first() }}</p>
		@endif
		<form action="/login/request" method="post">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<table width="450px">
				<tr>
					<td valign="top">
						<label for="email">Email</label>
					</td>
					<td valign="top">
						<input  type="text" name="email" maxlength="50" size="30">
					</td>
				</tr>

				<tr>
					<td valign="top">
						<label for="wachtwoord">Wachtwoord</label>
					</td>
					<td valign="top">
						<input type="password" name="password" maxlength="50" size="30">
					</td>
				</tr>

				<tr>
					<td colspan="2" style="text-align:center">
						<input type="submit" value="Login">
					</td>
				</tr>
			</table>
		</form>
	</div>
@endsection
@section('games')
	<div class="voorgrond">
		<?php try{ ?>
		@if(isset($products))
			@if(count($products) >= 1)
				<div>
					<form action="" method="get">
						<input class="search-panel" type="text" name="search">
					</form>
				</div>
				<div class="category">
					<table>
						<tr>
							<td>
								<span style="font-size: 20px;">Categorie</span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="/games">all</a>
							</td>
						</tr>
						@foreach($categories as $category)
						<tr>
							<td>
								<a href="/games/{{ $category->category }}">{{ $category->category }}</a>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
				<div class="products">
				@foreach($products as $product)
						<div class="productje">
							<a href="/{{ $product->product_id }}" target = "_blank"><img class="plaatje" src="/images/{{ $product->name }}" width="136" height="136" border /></a>
							<br><a href="/winkelwagen/{{ $product->product_id }}" class="under-panel">toevoegen!</a>
						</div>
				@endforeach
				</div>
			@else
				<table>
					<tr>
						<td>
							<a href="/{{ $product->product_id }}" target = "_blank"><img class="plaatje" src="/images/{{ $products->name }}.png" width="136" height="136" border /></a>
							<a href="/winkelwagen/{{ $product->product_id }}" class="under-panel">toevoegen!</a>
						</td>
					</tr>
				</table>
			@endif

		@endif
		<?php }catch(\Exception $e) {} ?>
	</div>
@endsection
@section('register')
	<div class="voorgrond">
		<h2>
			Account registreren
		</h2>
		@if(count($errors) >= 1)
			<p style="color:red;">{{ $errors->first() }}</p>
		@endif
		<p>
			Als u nog geen account heeft kunt u hieronder registreren.<br>
			Als u al een account heeft, klik dan op <a href="login.html">log in</a>.
		</p>

		<form action="/register/request" method="post">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<table width="450px">
				<tr>
					<td valign="top">
						<label for="first_name">Voornaam *</label>
					</td>
					<td valign="top">
						<input  type="text" name="first_name" maxlength="50" size="30">
					</td>
				</tr>

				<tr>
					<td valign="top">
						<label for="last_name">Achternaam *</label>
					</td>
					<td valign="top">
						<input  type="text" name="last_name" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="man">Man *</label>
					</td>
					<td valign="top">
						<input value="man" type="radio" name="sex" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="man">Vrouw *</label>
					</td>
					<td valign="top">
						<input value="woman" type="radio" name="sex" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="email">Email Address *</label>
					</td>
					<td valign="top">
						<input  type="text" name="email" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="wachtwoord">Wachtwoord *</label>
					</td>
					<td valign="top">
						<input  type="password" name="password" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="telephone">Telefoon nummer</label>
					</td>
					<td valign="top">
						<input  type="text" name="tel" maxlength="30" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="stad">Stad *</label>
					</td>
					<td valign="top">
						<input  type="text" name="city" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="straat">Straat *</label>
					</td>
					<td valign="top">
						<input  type="text" name="street" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="nummer">Huisnummer *</label>
					</td>
					<td valign="top">
						<input  type="text" name="house_number" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</div>
@endsection
@section('contact')
	<div class = "voorgrond">
		<h2>Contact Informatie</h2>

		<p> Als u vragen of opmerkingen heeft, dan kan u het volgende formulier invullen om contact met ons op te nemen.</p>

		<p>

		</p>
		<form action="MAILTO:Games4u@gmail.com" method="post" enctype="text/plain">
			<table width="450px">
				<tr>
					<td valign="top">
						<label for="first_name">Voornaam *</label>
					</td>
					<td valign="top">
						<input  type="text" name="first_name" maxlength="50" size="30">
					</td>
				</tr>

				<tr>
					<td valign="top">
						<label for="last_name">Achternaam *</label>
					</td>
					<td valign="top">
						<input  type="text" name="last_name" maxlength="50" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="email">Email Address *</label>
					</td>
					<td valign="top">
						<input  type="text" name="email" maxlength="80" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="telephone">Telefoon nummer</label>
					</td>
					<td valign="top">
						<input  type="text" name="telephone" maxlength="30" size="30">
					</td>
				</tr>
				<tr>
					<td valign="top">
						<label for="comments">Vragen/Opmerkingen *</label>
					</td>
					<td valign="top">
						<textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
					</td>

				</tr>
				<tr>
					<td colspan="2" style="text-align:center">
						<input type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</div>
@endsection
@section('tetris')
	
	<div class="voorgrond">
		<h1>
			Tetris</br>

		</h1>
		<p>
			<a href="http://tinyurl.com/q5k3nfd" target = "_blank"><img class="pacman" src="images/Tetris.png" width="250" height="250" STYLE="float:left;" /></a>
			<div class = "tekst">Dit is een van de oudste games.</br>
			Heel veel mensen hebben dit spel wel gespeeld of spelen het nog steeds. </br>
			Het is een leuke game en het blijft een leuke game.
			</div>
		</p>

	</div>
@endsection
@section('mario')
	
	<div class="voorgrond">
		<h1>
			Mario</br>

		</h1>
		<p>
			</br><a href="http://tinyurl.com/q5k3nfd" target = "_blank"><img class="pacman" src="images/Mario.png" width="250" height="250" STYLE="float:left;" /></a>
		<div class = "tekst">Dit is een van de klassiekers</br>
			Heel veel mensen hebben dit spel wel gespeeld of spelen het nog steeds. </br>
			Het is een leuke game en het blijft een leuke game.
		</div>
		</p>

	</div>
@endsection
@section('pacman')
	
	<div class="voorgrond">
		<h1>
			Pacman</br>

		</h1>
		<p>
			</br><a href="http://tinyurl.com/os2opcm" target = "_blank"><img class="pacman" src="images/pacman.png" width="250" height="250" STYLE="float:left;" /></a>
		<div class = "tekst">Dit is een van de oudste games. De meeste mensen hebben dit wel gespeeld. </br>
			Het is een leuke game en het blijft een leuke game.
		</div></p>

	</div>
@endsection
@section('overview')
	<div class="voorgrond">
		@if(isset($products) && isset($total))
			<div class="tabelmidden">
			<table border="1">
				<tr>
					<th>order id</th><th>image</th><th>naam</th><th>prijs per stuk</th><th>aantal</th><th>wijzig aantal</th>
				</tr>
					@foreach($products as $prod)
						<tr>
							@foreach($prod as $item)
								<td>{!! $item !!}</td>
							@endforeach
							<td>
								<form class="form-products" method="post" action="">
									<input name="_token" type="hidden" value="{{ csrf_token() }}">
									<input name="order_id" type="hidden" value="{{ $prod['order_id'] }}">
									<input class="add-amount" type="submit" value="voeg 1 toe">
									<input class="del-amount" type="submit" value="verwijder 1">
								</form>
							</td>
						</tr>
					@endforeach
				<tr>
					<td colspan="5" style="text-align:right;">totaal: {{ $total }}</td>
				</tr>
			</table>
			door winkelen? <a href="/games">klik hier!</a><br>
			jij nu snel kopen? <a href="/winkelwagen/payment/request">klik hier!</a><br>
				</div>
		@endif
	</div>
@endsection

@section('newProduct')

	<div class="voorgrond">
		<form method="post" action="/product/toevoegen/request" enctype="multipart/form-data" files="true">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			product naam is gelijk aan de image naam.<br>
			product beschrijving:<br> <input type="text" name="product_desc"><br>
			product categorie:<br> <input type="text" name="product_cat"><br>
			product prijs:<br> <input type="text" name="product_price"><br>
			product image:<br> <input type="file" accept="image/jpg" name="product_image"><br>
			<br> <input type="submit">
		</form>
	</div>
@endsection
