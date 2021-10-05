<?php
namespace App\Modules\Api\Services;

class DeviceSearchService
{
	public function search($queryBuilder, $request)
	{
		if ($request->id) {
			$queryBuilder->where("id", "=", $request->id);
		}

		if ($request->category_id) {
			$queryBuilder->where("category_id", "=", $request->category_id);
		}

		if ($request->color) {
			$queryBuilder->where("color", "=", $request->color);
		}

		if ($request->partNumber) {
			$queryBuilder->where("partNumber", "=", $request->partNumber);
		}

		if ($request->order) {
			$order = ($request->order == "asc") ? "asc" : "desc";
			$queryBuilder->orderBy("id", $order);
		}

		return $queryBuilder->paginate(($request->count) ? $request->count : 10);
	}
}