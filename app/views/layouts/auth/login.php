<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header text-center">

<h3>Sistema de Calibração</h3>

</div>

<div class="card-body">

<form method="POST" action="login.php">

<div class="mb-3">

<label>E-mail</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Senha</label>

<input
type="password"
name="senha"
class="form-control"
required>

</div>

<button
class="btn btn-primary w-100">

Entrar

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>