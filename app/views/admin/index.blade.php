<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta id="token" name="token" value="{{ csrf_token() }}">
	<title>Admin</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<style>
		body { padding: 2em 0; }
	</style>
</head>
<body class="container">
<h3>User</h3>

<form id="users" class="form-inline" action="" method="post" >
	<div class="form-group">
		<label class="sr-only">Email</label>
		<input type="text" v-model="user.email" class="form-control" placeholder="email du compte" autocomplete="off">
	</div>

	<button class="btn btn-default" v-on="click: afficherUser">Afficher</button>
	<button class="btn btn-default" v-on="click: passerInactif">Passer inactif</button>
	<button class="btn btn-default" v-on="click: forceDeleteUser">Supprimer definitivement</button>

    <table class="table" v-if="display">
        <thead>
        <tr>
            <th>id</th>
            <th>email</th>
            <th>devise</th>
            <th>timezone</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>@{{ user.all.id }}</td>
            <td>@{{ user.all.email }}</td>
            <td>@{{ user.all.devise }}</td>
            <td>@{{ user.all.timezone }}</td>
        </tr>
        </tbody>
    </table>

	<div class="alert alert-success" v-if="inactif">@{{ user.email }} est desormais inactif</div>
	<div class="alert alert-success" v-if="deleted">@{{ user.email }} supprimé</div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.16/vue-resource.min.js"></script>

{{ HTML::script('js/admin/admin.js')}}


</body>
</html>