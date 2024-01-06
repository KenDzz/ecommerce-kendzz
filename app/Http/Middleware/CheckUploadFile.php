<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckUploadFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $validator = Validator::make($request->all(), [
                'upload' => 'image|max:10000|mimes:jpeg,png,gif,webp',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid file upload', 'errors' => $validator->errors()], 400);
            }

            try {
                $image = \Image::make($file->getRealPath());
                $mime = $image->mime();
                if (strpos($mime, 'image/') != 0) {
                    return response()->json(['message' => 'Invalid file upload', 'errors' => $validator->errors()], 400);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'Could not process the image'], 400);
            }
        }

        return $next($request);
    }
}
