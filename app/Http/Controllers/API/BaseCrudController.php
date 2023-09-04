<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\JsonResponse;

class BaseCrudController extends Controller
{
    protected Model $model;
    protected EloquentBuilder | QueryBuilder $modelQuery;
    protected $rules = [];


    protected $start = 0;
    protected $length = 10;
    protected $columnOrder;
    protected $sortOrder = "DESC";
    protected $searchFields = [];

    public $customFilter;

    public function index(Request $request): JsonResponse
    {
        return $this->generatePagination($request);
    }

    public function generatePagination(Request $request): JsonResponse
    {
        $start = $request->query("start", $this->start);
        $rowPerPage = $request->query("length", $this->length);
        $searchValue = $request->query("search")["value"] ?? "";
        $columnIndex =  $request->query("order")[0]["column"] ?? 0;
        $columnName =  $request->query("columns")[$columnIndex]["data"] ?? $this->columnOrder;
        $columnSortOrder =  $request->query("order")[0]["dir"] ?? $this->sortOrder;

        $recordsTotal = $recordsFiltered = $this->modelQuery->count();

        if (isset($this->customFilter) &&  is_callable($this->customFilter)) {
            $customFilter = $this->customFilter;
            $customFilter();
            $recordsFiltered = $this->modelQuery->count();
        }

        $data = $this->modelQuery->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($rowPerPage)->get();

        $response = [
            "draw"  =>  intval($request->query("draw") ?? 0),
            "start" => $start,
            "length"   =>  $rowPerPage,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        return $this->modelQuery->find($id);
    }
}
