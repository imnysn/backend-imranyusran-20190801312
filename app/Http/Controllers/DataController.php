<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Data;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DataController extends Controller
{
    public function index() {
        $data = Data::orderBy('id', 'desc')->get();

        $response = [
            'message' => "List Data",
            'data' => $data,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nim'        => ['required', 'numeric', 'digits:11'],
            'nama'       => ['required', 'string', 'max:80'],
            'fakultas'   => ['required', 'string', 'max:80'],
            'prodi'      => ['required', 'string', 'max:80'],
            'email'      => ['required', 'email'],
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = Data::create($request->all());

            $response = [
                'message' => "Sukses",
                'data' => $data,
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal, ' . $e->errorinfo,
            ]);
        }
    }

    public function show($id) {
        $data = Data::findOrFail($id);

        try {
            $response = [
                'message' => "Detail Data",
                'data' => $data,
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data Tidak Ada, ' . $e->errorinfo,
            ]);
        }
    }

    public function update(Request $request, $id) {
        $data = Data::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nim'        => ['required', 'numeric', 'digits:11'],
            'nama'       => ['required', 'string', 'max:80'],
            'fakultas'   => ['required', 'string', 'max:80'],
            'prodi'      => ['required', 'string', 'max:80'],
            'email'      => ['required', 'email'],
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data->update($request->all());

            $response = [
                'message' => "Sukses",
                'data' => $data,
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal, ' . $e->errorinfo,
            ]);
        }
    }

    public function destroy($id) {
        $data = Data::findOrFail($id);

        try {
            $data->delete();

            $response = [
                'message' => "Sukses",
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal, ' . $e->errorinfo,
            ]);
        }
    }
}
