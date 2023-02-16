<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    protected $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {

            $request->validate([
                'file' => 'required|mimes:txt',
            ]);

            if ($request->file()) {
                $this->fileService->storeMeetingData($request->file);
            }

            return response()->json(['success' => 'Successfully data insert'], 201);

        }catch (\Exception $e)
        {
            \Log::error(json_encode($e->getMessage()));
            return response()->json(['error' => json_encode($e->getMessage())], 400);
        }

    }

}
