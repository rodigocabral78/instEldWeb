<?php

namespace App\Modules\Api\Services;

use App\Modules\Api\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryService
{
	public function index(Request $request)
	{
		$categorySearchService = new CategorySearchService();
		return $categorySearchService->search(Category::with([]), $request);
	}

	public function show($id)
	{
		# $category = Category::findOrFail($id);
		$category = Category::find($id);

		return $category;
	}

	public function store($request)
	{
		$validator = Validator::make($request->all(), [
			"name" => "required",
		]);

		if ($validator->errors()->count()) {
			throw new \Exception($validator->errors()->first(), 400);
		}

		if (!$validator->errors()->count()) {
			$data = [
				"name" => $request->name,
			];
			return Category::create($data);
		}
	}

	public function update($request, $id)
	{
		# $category = Category::find($id);

		$validator = Validator::make($request->all(), [
			"name" => "required",
		]);

		if ($validator->errors()->count()) {
			throw new \Exception($validator->errors()->first(), 400);
		}

		if (!$validator->errors()->count()) {
			$data = [
				"name" => $request->name,
			];
			$category = Category::find($id)->update($data);
		}
		return $category;
	}

	public function destroy($id)
	{
		$category = Category::find($id)->delete();
		return $category;
	}
}
