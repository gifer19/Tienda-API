<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
     public function getProducts(){

      $product = Product::all();

      $data = [
         'product' => $product,
         'status' => 200
     ];
        return response()-> json($data,200);
     }

     public function createProduct(Request $request){

      $validator = Validator::make($request->all(), [
         'name' => 'required',
         'description' => 'required',
         'price' => 'required',
         'category' => 'required'
     ]);

     if ($validator->fails()) {
         $data = [
             'message' => 'Error en la valverificacion de los datos ingresados del producto',
             'errors' => $validator->errors(),
             'status' => 400
         ];
         return response()->json($data, 400);
     }

     $product = Product::create([
         'name' => $request->name,
         'description' => $request->description,
         'price' => $request->price,
         'category' => $request->category
     ]);

     if (!$product) {
         $data = [
             'message' => 'Error al crear el producto',
             'status' => 500
         ];
         return response()->json($data, 500);
     }

     $data = [
         'product' => $product,
         'status' => 201
     ];

     return response()->json($data, 201);
     }

     public function getProductByID($id){
      $product = Product::find($id);

      if (!$product) {
          $data = [
              'message' => 'Producto no existe',
              'status' => 404
          ];
          return response()->json($data, 404);
      }

      $data = [
          'product' => $product,
          'status' => 200
      ];

      return response()->json($data, 200);

     }
     public function updateProductByID(Request $request, $id)
     {
         $product = Product::find($id);
 
         if (!$product) {
             $data = [
                 'message' => 'El producto no se encuentra registrado',
                 'status' => 404
             ];
             return response()->json($data, 404);
         }
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la verificacion de la informacion de los productos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;

        $product->save();

        $data = [
            'message' => 'Producto actualizado',
            'student' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function deleteProductByID($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $data = [
                'message' => 'Producto no registrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $product->delete();

        $data = [
            'message' => 'Producto fue eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
