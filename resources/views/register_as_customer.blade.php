<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div>
		<div>
			<form action="/register" method="POST">
				@csrf
				<input type="hidden" name="role" value="customer">
				<label for="">Nama Lengkap</label>
				<input type="text" name="name" placeholder="Nama Lengkap">
				<label for="">Email</label>
				<input type="email" name="emai" placeholder="Email">
				<label for="">Nomoe HP/Telepon</label>
				<input type="tel" name="phone" placeholder="Nomor HP">
				<label for="">Password</label>
				<input type="password" name="password" placeholder="Password">
				<label for="">Konfirmasi Password</label>
				<input type="password" name="password_confirmation" placeholder="Konfirmasi Password">
				<button>Daftar</button>
				<div>Atau</div>
				<button>Lanjutkan dengan Google</button>
			</form>
		</div>
		<div></div>
	</div>
</body>
</html>