<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductsTag;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function Index($lang = 'en') {
        if(!in_array($lang, ['en','ru','am'])){
           $lang = 'en';  
        }
        $products = Product::with('producttags.tags')->get();
        foreach ($products as $product) {
            $product->name = json_decode($product->name,true)['name_'.$lang];
            $product->description = json_decode($product->description,true)['description_'.$lang];
        }
        return view("product.index",compact(['products']));
    }
    public function CreatePage() {
        $tags = Tag::get();
        return view("product.create",compact(['tags']));
    }
    public function Create(Request $request) {
        $validated = Validator::make($request->all(), [
            'name_am' => 'required|min:2',
            'name_ru' => 'required|min:2',
            'name_en' => 'required|min:2',
            'description_am' => 'required|min:2',
            'description_ru' => 'required|min:2',
            'description_en' => 'required|min:2',
            'tag' => 'required|array|min:2',
            'image' => 'required'
        ]);
        if($validated->fails()){
            return redirect()->back()->with([
                'errors' => $validated->errors(),
            ])->withInput();
        }
        else{
            $name_json = [
                'name_am' => $request->name_am,
                'name_ru' => $request->name_ru,
                'name_en' => $request->name_en,
            ];
            $description_json = [
                'description_am' => $request->description_am,
                'description_ru' => $request->description_ru,
                'description_en' => $request->description_en,
            ];
            $name_json = json_encode($name_json);
            $description_json = json_encode($description_json);
            
            $product = new Product;
            $product->name = $name_json;
            $product->description = $description_json;
            if($request->file('image')){
                $image = $request->file('image');
                $filename = date('YmdHi').$image->getClientOriginalName();
                $image->move(public_path('/images'), $filename);
                $image = $filename;
            }
            $product->image = $filename;
            $product->save();

            foreach($request->tag as $tag){
                $productsTag = new ProductsTag;
                $productsTag->product_id = $product->id;
                $productsTag->tag_id = $tag;
                $productsTag->save();
            }
            return redirect()->back()->with(['status' => 'Product is added !']);
        }
    }
    public function Delete(Request $request) {
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        unlink(public_path('images/'.$product->image));
        Product::find($product_id)->delete();
        return redirect()->back();
    }
    public function UpdatePage($product_id) {
        $product = Product::where('id', $product_id)->first();
        $tags = Tag::get();
        $productTags = Arr::flatten(ProductsTag::where('product_id',$product_id)->get('tag_id')->toArray());
        return view("product.update" , compact(['product', 'tags', 'productTags']));
    }
    public function Update(Request $request) {
        $validated = Validator::make($request->all(), [
            'name_am' => 'required|min:2',
            'name_ru' => 'required|min:2',
            'name_en' => 'required|min:2',
            'description_am' => 'required|min:2',
            'description_ru' => 'required|min:2',
            'description_en' => 'required|min:2',
            'tag' => 'required|array|min:2',
        ]);
        if($validated->fails()){
            return redirect()->back()->with([
                'errors' => $validated->errors(),
            ])->withInput();
        }
        else{
            $product = Product::where('id', $request->product_id)->first();
            $name_json = [
                'name_am' => $request->name_am,
                'name_ru' => $request->name_ru,
                'name_en' => $request->name_en,
            ];
            $description_json = [
                'description_am' => $request->description_am,
                'description_ru' => $request->description_ru,
                'description_en' => $request->description_en,
            ];
            $name_json = json_encode($name_json);
            $description_json = json_encode($description_json);
            
            $product->name = $name_json;
            $product->description = $description_json;
            if($request->file('image')){
                unlink(public_path('images/'.$product->image));
                $image = $request->file('image');
                $filename = date('YmdHi').$image->getClientOriginalName();
                $image->move(public_path('/images'), $filename);
                $image = $filename;
                $product->image = $filename;
            }
            $product->save();

            ProductsTag::where('product_id',$request->product_id)->delete();    
            foreach($request->tag as $tag){
                $productsTag = new ProductsTag;
                $productsTag->product_id = $product->id;
                $productsTag->tag_id = $tag;
                $productsTag->save();
            }
            return redirect()->back()->with([
                'status' => 'Product is updated !'
            ]);
        }
    }
}
