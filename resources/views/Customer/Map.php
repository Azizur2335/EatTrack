<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<title>Document</title>
</head>
<body>
	<x-navbar></x-navbar>
	<div>
		<div>
			<input type="text">
			<p>Ditemukan {{}} restoran</p>
			<div>
				<div class="flex">
					<div></div>
					<div>
						<h3>{{nama restoran}}</h3>
						<p>{{deskripsi}}</p>
						<div class="bg-orange-200">{{buka}}</div>
						<div>
							<div></div>
							<p>0,3 km</p>
						</div>
						<div>
							<div></div>
							<p>4,5</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div></div>
	</div>
</body>
</html>