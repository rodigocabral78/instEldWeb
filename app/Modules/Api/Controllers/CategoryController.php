<?php

namespace App\Modules\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Api\Services\CategoryService;

class CategoryController extends Controller
{
	private $categoryService;

	function __construct(CategoryService $categoryService)
	{
		$this->categoryService = $categoryService;
	}

	public function index(Request $request)
	{
		try {
			$data =  $this->categoryService->index($request);
			return response()->json($data, 200);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"error" => $e,
			];
			return response()->json($data, 400);
		}
	}

	public function show($id)
	{
		try {
			$data = $this->categoryService->show($id);
			return response()->json($data, 200);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"error" => $e,
			];
			return response()->json($data, 400);
		}
	}

	public function store(Request $request)
	{
		try {
			$data = $this->categoryService->store($request);
			return response()->json($data, 201);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"error " => $e,
			];
			return response()->json($data, 400);
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$data = $this->categoryService->update($request, $id);
			return response()->json($data, 200);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"error" => $e,
			];
			return response()->json($data, 400);
		}
	}

	public function destroy($id)
	{
		try {
			$data = $this->categoryService->destroy($id);
			# return response()->json($data, 200);
			return response()->json($data, 204);
		} catch (\Exception $e) {
			$data = [
				"message" => "Error, try again!",
				"error" => $e,
			];
			return response()->json($data, 400);
		}
	}
}
