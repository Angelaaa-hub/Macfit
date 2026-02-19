<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bundle;           // ← Fixed: assuming your model is called Bundle

class BundlesController extends Controller
{
    /**
     * Create a new bundle
     */
    public function createBundle(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|unique:bundles,name',           // table name = bundles (plural)
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            $bundle = Bundle::create($validated);

            return response()->json([
                'success' => true,
                'bundle'  => $bundle                // ← consistent key name
            ], 201);                                    // 201 = Created
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error'   => 'Failed to create bundle',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Get all bundles
     */
    public function readAllBundles()
    {
        try {
            $bundles = Bundle::all();               // or ->paginate(15) if many records

            return response()->json([
                'success' => true,
                'bundles' => $bundles
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error'   => 'Failed to fetch bundles',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Get a single bundle by ID
     */
    public function readBundle($id)
    {
        try {
            $bundle = Bundle::findOrFail($id);

            return response()->json([
                'success' => true,
                'bundle'  => $bundle
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error'   => "Bundle with ID {$id} not found",
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    /**
     * Update a bundle
     */
    public function updateBundle(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name'        => 'required|string|unique:bundles,name,' . $id,   // ignore current record
                'description' => 'nullable|string|max:1000',
            ]);

            $bundle = Bundle::findOrFail($id);
            $bundle->update($validated);

            return response()->json([
                'success' => true,
                'bundle'  => $bundle->fresh()           // reload fresh data
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error'   => "Failed to update bundle with ID {$id}",
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a bundle
     */
    public function deleteBundle($id)
    {
        try {
            $bundle = Bundle::findOrFail($id);
            $bundle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bundle deleted successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error'   => 'Failed to delete bundle',
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}