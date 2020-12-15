<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        //$data = ['data' => $this->product->all() ];
        return response()->json($this->product->paginate(5));
    }

    public function show($id){
        $product = $this->product->find($id);
        if(! $product) return response()->json(['data' => ['msg' => 'Produto não encontrado']],404);
        $data  = ['data' => $product];
        return response()->json($data);
    }

    public function store(Request $request){
        try{
            $productData = $request->all();
            $this->product->create($productData);
            $return = ['data' => ['msg' => 'Produto criado com sucesso!']];
            return response()->json($return ,201);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1010));
            }
            return response()->json(ApiError::errorMessage("Houve um erro ao realizar a operação de cadastro"));
        }
    }

    
    public function update(Request $request, $id){
        try{
            $productData = $request->all();
            $product     = $this->product->find($id);
            $product->update($productData);

            $return = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
            return response()->json($return ,201);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1011));
            }
            return response()->json(ApiError::errorMessage("Houve um erro ao realizar a operação de atualizar"));
        }
    }

    public function delete(Product $id){
        try{
            $id->delete();
            $return = ['data' => ['msg' => 'Produto '. $id->name .' deletado com sucesso!']];
            return response()->json($return ,200);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1012));
            }
            return response()->json(ApiError::errorMessage("Houve um erro ao realizar a operação de deletar"));
        }
    }
}
