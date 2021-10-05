<?php

namespace App\Modules\Api\Services;

use App\Modules\Models\Device;
// use App\Modules\Services\DeviceSearchService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DeviceService
{
	public function index(Request $request)
	{
		$deviceSearchService = new DeviceSearchService();
		return $deviceSearchService->search(Device::with([]), $request);
	}

	public function show($id)
	{
		# $device = Device::findOrFail($id);
		$device = Device::find($id);

		return $device;
	}

	public function store($request)
	{
		$validator = Validator::make($request->all(), [
			"category_id" => "required",
			"color" => "required",
			"partNumber" => "required",
		]);

		if ($validator->errors()->count()) {
			throw new \Exception($validator->errors()->first(), 400);
		}

		if (!$validator->errors()->count()) {
			$data = [
				"category_id" => $request->category_id,
				"color" => $request->color,
				"partNumber" => $request->partNumber,
			];
			return Device::create($data);
		}
	}

	public function update($request, $id)
	{
		$validator = Validator::make($request->all(), [
			"category_id" => "required",
			"color" => "required",
			"partNumber" => "required",
		]);

		if ($validator->errors()->count()) {
			throw new \Exception($validator->errors()->first(), 400);
		}

		if (!$validator->errors()->count()) {
			$data = [
				"category_id" => $request->category_id,
				"color" => $request->color,
				"partNumber" => $request->partNumber,
			];
			return Device::where(["id" => $id])->update($data);
		}
	}

	public function destroy($id)
	{
		return Device::where(["id" => $id])->delete();
	}
}
