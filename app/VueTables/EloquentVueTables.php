<?php

namespace App\VueTables;

Class EloquentVueTables implements VueTablesInterface {

    public function get( $model, Array $fields, Array $relations = []) {
        //obtencion de los datos
        $byColumn  = request( 'byColumn' );
        $orderBy  = request( 'orderBy' );
        $limit     = request( 'limit' );
        $page      = request( 'page' );
        $ascending = request( 'ascending' );
        $query     = json_decode( request( 'query' ), true );
        //select con campos y relaciones
        $data      = $model->select( $fields )->with($relations);

        //comprobamos si lo estamos enviando , si lo enviamos procederemos al filtro
        if(request('status')) {
            $data->where('status', request('status'));
        }
          // cuando escribamos, enviara a filterByColumn
        if ( isset( $query ) && $query ) {
            $data = $byColumn == 1 ? $this->filterByColumn( $data, $query ) : $this->filter( $data, $query, $fields );
        }

        $count = $data->count();
        //ordenar la tabla en orden ascendente o descendente
        $data->limit( $limit )->skip( $limit * ( $page - 1 ) );
        if ( isset( $orderBy )) {
            $direction = $ascending == 1 ? "ASC" : "DESC";
            $data->orderBy( $orderBy, $direction );
        }

        $results = $data->get()->toArray();

        return [
            'data'  => $results,
            'count' => $count
        ];
    }

    // $field es lo que escribimos y $query lo que busca, si lo que buscamos es "curso"
    protected function filterByColumn( $data, $query ) {
        foreach ( $query as $field => $query ) {
            if ( ! $query ) {
                continue;
            }
            // aqui "curso es $field y hace la consulta de busqueda
            if ( is_string( $query ) && $field !== "status" ) {
                $data->where( $field, 'LIKE', "%{$query}%" );
            }
        }

        return $data;
    }

    protected function filter( $data, $query, $fields ) {
        foreach ( $fields as $index => $field ) {
            $method = $index ? "orWhere" : "where";
            $data->{$method}( $field, 'LIKE', "%{$query}%" );
        }

        return $data;
    }
}