<?php
namespace App\VueTables;
//esta interfaz la encontramos en el repositorio de github de vue tables
interface VueTablesInterface {
    // esta interfaz tiene el modelo o tabla, las columnas y las relaciones
	public function get($model, Array $fields, Array $relations = []);
}