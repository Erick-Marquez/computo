<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;

// ApiTrait es una clase abstracte que incluye todos los metodos en un modelo
trait ApiTrait
{

    // La instancia $query hace referencia a la consulta que tienes en el controlador
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {

            if (!$allowIncluded->contains($relationship)) {

                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    // Con esta funcion se puede filtrar los datos en la consulta
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $valor) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $valor . '%');
            }
        }

    }

    public function scopeSearch(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('search'))) {
            return;
        }

        $searchs = request('search');
        $allowSearch = collect($this->allowSearch);

        foreach ($searchs as $search => $valor) {
            if ($allowSearch->contains($search)) {
                $query->orWhere($search, 'LIKE', '%' . $valor . '%');
            }
        }
    }

    // funcion para ordenar que obtiene como parametro la consulta
    public function scopeSort(Builder $query)
    {
        // Verifica si exite la variable sort, y si se envio por la URL
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        // al enviarse de la forma sort=pam1,pam2,... Sort es un string, la funcion explode los separa por las comas
        $sortFields = explode(',', request('sort'));
        // se convierte en una coleccion, no se que es una coleccion xd, pero esta es la lista blanca que esta inicio de la clase
        $allowSort = collect($this->allowSort);

        // se itera los elementos de la matriz y se compara con la lista blanca
        foreach ($sortFields as $sortField) {

            // + ó - para ordenar por ascendente o descendente
            $direction = 'asc';

            // si la matriz se envia con un -, ejem: sort=-name, se detectara el signo
            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                // de ser el caso que este se extrara del parametro
                $sortField = substr($sortField, 1);
            }

            // por ultimo se verifica si la lista blanca contiene a algun indice de la matriz
            if ($allowSort->contains($sortField)) {
                // de ser el caso se ejecutara un order by a la consulta
                $query->orderBy($sortField, $direction);
            }
        }
    }

    public function scopeDateInterval(Builder $query)
    {

        if (empty($this->allowDateInterval) || empty(request('dateInterval'))) {
            return;
        }

        $dates = request('dateInterval');
        $allowDateInterval = collect($this->allowDateInterval);

        foreach ($dates as $date => $valor) {
            if ($allowDateInterval->contains($date)) {
                $fechas = explode(',', $valor);
                $query->whereDate($date, '>=', $fechas[0])->whereDate($date, '<=', $fechas[1]);
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intVal(request('perPage'));


            return $query->paginate($perPage);
        }
        return $query->get();
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = Date::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
