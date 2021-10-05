<?php

namespace App\Modules\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Api\Services\DeviceService;

class DeviceController extends Controller
{
	private $deviceService;

	function __construct(DeviceService $deviceService)
	{
		$this->deviceService = $deviceService;
	}

	public function index(Request $request)
	{
		try {
			$data =  $this->deviceService->index($request);
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
			$data = $this->deviceService->show($id);
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
			$data = $this->deviceService->store($request);
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
			$data = $this->deviceService->update($request, $id);
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
			$data = $this->deviceService->destroy($id);
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
