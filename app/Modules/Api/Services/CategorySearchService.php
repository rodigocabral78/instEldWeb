<?php

namespace App\Modules\Api\Services;

class CategorySearchService
{
	public function search($queryBuilder, $request)
	{
		if ($request->id) {
			$queryBuilder->where("id", "=", $request->id);
		}

		if ($request->name) {
			$queryBuilder->where("name", "=", $request->name);
		}

		if ($request->order) {
			$order = ($request->order == "asc") ? "asc" : "desc";
			$queryBuilder->orderBy("id", $order);
		}

		return $queryBuilder->paginate(($request->count) ? $request->count : 10);
	}
}