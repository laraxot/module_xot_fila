<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Modules\UI\Services\FieldFilter;
use Modules\Xot\Contracts\RowsContract;
use Modules\Xot\DTOs\FieldFilterDTO;

// ----------- Requests ----------

// per dizionario morph
// ------------ services ----------

/**
 * Class ModelService.
 */
class RowsService
{
    /**
     * Undocumented function.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function search($query, ?string $q, array $search_fields = [])
    {
        // backtrace(true);
        // dddx([$query, $q, $search_fields]);

        if (! isset($q)) {
            return $query;
        }

        $model = $query->getModel();
        /*
        $test = QueryBuilder::for($query)
            //->allowedFilters(Filter::FiltersExact('q', 'matr'))
            ->allowedFilters([AllowedFilter::exact('q', 'matr'), AllowedFilter::exact('q', 'ente')])
            // ->allowedIncludes('posts')
            //->allowedFilters('matr')
            ->get();
        */
        /*
            ->allowedFilters([
                Filter::search('q', ['first_name', 'last_name', 'address.city', 'address.country']),
            ]);
        */
        // dddx($test);

        $tipo = 0; // 0 a mano , 1 repository, 2 = scout
        switch ($tipo) {
            case 0:
                // $search_fields = $this->search(); //campi di ricerca
                if (0 === \count($search_fields)) { // se non gli passo nulla, cerco in tutti i fillable
                    // 61     Call to an undefined method Illuminate\Database\Eloquent\Model|Modules\Xot\Contracts\RowsContract::getFillable().
                    $search_fields = $model->getFillable();
                }
                // $table = $model->getTable();
                if (\strlen($q) > 1) {
                    $query = $query->where(
                        function ($subquery) use ($search_fields, $q): void {
                            foreach ($search_fields as $k => $v) {
                                if (Str::contains($v, '.')) {
                                    [$rel, $rel_field] = explode('.', $v);

                                    // dddx([$rel, $rel_field]);

                                    $subquery = $subquery
                                        // ->with([$rel])
                                        // ->setConnection('liveuser_general')
                                        ->orWhereHas(
                                            $rel,
                                            function (Builder $subquery1) use ($rel_field, $q): void {
                                                // dddx($subquery1->getConnection()->getDatabaseName());

                                                $subquery1->where($rel_field, 'like', '%'.$q.'%');
                                                // dddx($subquery1);
                                            }
                                        );

                                // dddx($subquery);
                                } else {
                                    $subquery = $subquery->orWhere($v, 'like', '%'.$q.'%');
                                }
                            }
                        }
                    );
                }
                // dddx(['q' => $q, 'sql' => $query->toSql()]);

                return $query;
                // break;
            case 1:
                // $repo = with(new \Modules\Food\Repositories\RestaurantRepository())->search('grom');
                // dddx($repo->paginate());
                // return $repo;
                break;
            case 2:
                break;
        } // end switch

        return $query;
    }

    // end applySearch

    /**
     * Undocumented function.
     *
     * @see https://github.com/spatie/laravel-query-builder
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function filter($query, array $filters, array $filters_fields)
    {
        $filters_fields = FieldFilterDTO::collection($filters_fields);
        $filters_rules = [];

        foreach ($filters_fields as $fitem) {
            if (null !== $fitem->rules) {
                $filters_rules[$fitem->param_name] = $fitem->rules;
            }
        }
        $validator = Validator::make($filters, $filters_rules);
        if ($validator->fails()) {
            Session::flash('error', 'error');
            $id = $query->getModel()->getKeyName();

            return $query->whereNull($id); // restituisco query vuota
        }

        $filters_fields = $filters_fields
            ->filter(
                function ($item) use ($filters) {
                    return \in_array($item->param_name, array_keys($filters), true);
                }
            )
            ->all();

        foreach ($filters_fields as $k => $v) {
            $filter_val = $filters[$v->param_name];
            if ('' !== $filter_val) {
                if (! isset($v->op)) {
                    $v->op = '=';
                }
                if (isset($v->where_method)) {
                    if (! isset($v->field_name)) {
                        dddx(['err' => 'field_name is missing']);

                        return $query;
                    }
                    $query = $query->{$v->where_method}($v->field_name, $filter_val);
                } else {
                    $query = $query->where($v->field_name, $v->op, $filter_val);
                }
            }
        }

        return $query;
    }
}
