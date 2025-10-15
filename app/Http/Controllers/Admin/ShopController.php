<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Shop;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ShopController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Shop Show', only: ['index','show']),
            new Middleware('permission:Shop Create', only: ['create','store']),
            new Middleware('permission:Shop Edit', only: ['edit','update']),
            new Middleware('permission:Shop Delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $shops = Shop::latest()->get();  
        return view('admin.shop.index',compact('shops'));
    }

    public function create()
    {
        return view('admin.shop.create');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
        
            $validator = Validator::make($request->all(), [
                'shop_name' => 'required|max:255',
                'shop_address' => 'required|max:255',
                'shop_contact_person_name' => 'required|max:255',
                'shop_contact_person_phone' => 'required|max:255',
                'shop_latitude' => 'nullable|numeric',
                'shop_longitude' => 'nullable|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_visible' => 'required|in:0,1',
            ]);        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            $maxNumber = Shop::max('shop_number');
            $newNumber = $maxNumber ? $maxNumber + 1 : 10000;
            $data = Shop::create([
                'shop_number'=>$newNumber,
                'shop_name' => $request->shop_name,
                'shop_address' => $request->shop_address,
                'shop_contact_person_name' => $request->shop_contact_person_name,
                'shop_contact_person_phone' => $request->shop_contact_person_phone,
                'shop_latitude' => $request->shop_latitude,
                'shop_longitude' => $request->shop_longitude,
                'is_visible' => $request->is_visible,
            ]);

            if ($request->hasFile('image')) {
                $data->addMedia($request->file('image'))->toMediaCollection('shop-image');
            }elseif ($request->filled('shop_image_from_google')) {
                try {
                    $googleImageUrl = $request->shop_image_from_google;
                    $imageContents = file_get_contents($googleImageUrl);
                    $tempFile = tmpfile();
                    $tempPath = stream_get_meta_data($tempFile)['uri'];
                    fwrite($tempFile, $imageContents);
                    $data->addMedia($tempPath)
                        ->usingFileName('shop_' . time() . '.jpg')
                        ->toMediaCollection('shop-image');
                    fclose($tempFile);
                } catch (\Exception $e) {
                    \Log::error('Failed to save Google image: ' . $e->getMessage());
                }
            }


            if($data->id){
                return redirect()->route('shop.index')->with(['success'=>'Shop Created Successfully']);
            }else{
                return back()->with(['error'=>'Shop Not Created']);
            }
        }
    }

    public function show(Shop $shop)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Shop::findOrFail($id);
        return view('admin.shop.edit',compact('data'));
    }

    public function update(Request $request, string $id)
    {
        if ($request->isMethod('put') || $request->isMethod('patch')) {
            
            $validator = Validator::make($request->all(), [
                'shop_name' => 'required|max:255',
                'shop_address' => 'required|max:255',
                'shop_contact_person_name' => 'required|max:255',
                'shop_contact_person_phone' => 'required|max:255',
                'shop_latitude' => 'nullable|numeric',
                'shop_longitude' => 'nullable|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_visible' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            // Find the shop by ID
            $shop = Shop::findOrFail($id);

            // Update shop details
            $shop->update([
                'shop_name' => $request->shop_name,
                'shop_address' => $request->shop_address,
                'shop_contact_person_name' => $request->shop_contact_person_name,
                'shop_contact_person_phone' => $request->shop_contact_person_phone,
                'shop_latitude' => $request->shop_latitude,
                'shop_longitude' => $request->shop_longitude,
                'is_visible' => $request->is_visible,
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Remove the previous image
                $shop->clearMediaCollection('shop-image');

                // Upload new image
                $shop->addMedia($request->file('image'))->toMediaCollection('shop-image');
            }elseif ($request->filled('shop_image_from_google')) {
                try {
                    $shop->clearMediaCollection('shop-image');
                    $googleImageUrl = $request->shop_image_from_google;
                    $imageContents = file_get_contents($googleImageUrl);
                    $tempFile = tmpfile();
                    $tempPath = stream_get_meta_data($tempFile)['uri'];
                    fwrite($tempFile, $imageContents);
                    $shop->addMedia($tempPath)
                        ->usingFileName('shop_' . time() . '.jpg')
                        ->toMediaCollection('shop-image');
                    fclose($tempFile);
                } catch (\Exception $e) {
                    \Log::error('Failed to save Google image: ' . $e->getMessage());
                }
            }

            return redirect()->route('shop.index')->with(['success' => 'Shop Updated Successfully']);
        }

        return back()->with(['error' => 'Invalid Request']);
    }


    public function destroy(string $id)
    {
        $shop = Shop::findOrFail($id);
        if (!$shop) {
            return redirect()->back()->withErrors(['error' => 'Shop not found.'])->withInput();
        }
        $shop->delete();
        return response()->json(['success' => 'Shop Deleted Successfully']);
    }
}
