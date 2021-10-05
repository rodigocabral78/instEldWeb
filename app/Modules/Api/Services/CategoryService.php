<?php

namespace App\Modules\Api\Services;

use App\Modules\Models\Category;
// use App\Modules\\Services\CategorySearchService;
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

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => ['bail', 'sometimes', 'required', 'string', 'max:128', 'unique:categories'],
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

	public function update(Request $request, $id)
	{
		$category = Category::find($id);

		$validator = Validator::make($request->all(), [
			// 'name' => ['bail', 'sometimes', 'required', 'string', 'max:128', 'exists:categories,id', 'unique:categories'],
			// 'name' => ['bail', 'sometimes', 'required', 'string', 'max:128', 'unique:categories,name,' . $category->id],
			'name' => ['bail', 'sometimes', 'required', 'string', 'max:128', 'unique:categories,name,' . $id],
		]);

		// dd($validator);
		if ($validator->errors()->count()) {
			throw new \Exception($validator->errors()->first(), 400);
		}

		if (!$validator->errors()->count()) {
			$data = [
				"name" => $request->name,
			];
			$category = Category::find($id)->update($data);
			return $category;
		}
	}

	public function destroy($id)
	{
		$category = Category::find($id)->delete();
		return $category;
	}
}
