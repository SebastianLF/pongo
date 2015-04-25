<?php 
namespace lib\gestion;

interface UserGestionInterface {

    public function index($n);
	public function store();
	public function show($id);
	public function edit($id);
	public function update($id);
	public function destroy($id);

}