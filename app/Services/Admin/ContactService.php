<?php

namespace App\Services\Admin;

use App\Helpers\HttpResponseHelper; 
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactService{
    
    /* get all blog */
    public static function getAll(){
        try{ 
           
            return Contact::latest()->paginate(5);
        }catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
      
    }
    /* store blog */
    public static function storeDocument($request){
        return  ([
            'name' => $request->name,
            'email' => $request->email,
            'message' =>$request->message, 
            'phone' =>$request->phone, 
        ]);
    }
    // store blog
   public static function store($request){
    try{ 
        Mail::html( request()->message, function ($message) use ($request){
            $message->to('abdulmalek.swe.585@gmail.com')
                ->cc($request->email)
                    ->subject('HTML Test Email');
        });
        return  Contact::create(ContactService::storeDocument($request)); 
    }catch (\Throwable $th) {
        return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
    }
        
   }
//    show single blog 
    public static function show($id){ 
        try{ 
            return Contact::findOrFail($id);
        }catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
   // update single blog
   public static function update($request, $id){
    try{ 
         $blog = Contact::findOrFail($id);
         $blog->update(ContactService::storeDocument($request)); 
         return $blog;
    }catch (\Throwable $th) {
        return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
    }
   }
    // delete single blog
    public static function destroy($id){
        try{ 
            return Contact::findOrFail($id)->delete();
        }catch (\Throwable $th) {
            return HttpResponseHelper::errorResponse([$th->getMessage()], 500);
        }
    }
}