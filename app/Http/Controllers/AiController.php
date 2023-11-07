<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenAI as GlobalOpenAI;
use OpenAI\Laravel\Facades\OpenAI;

class AiController extends Controller
{
public function transcribe(Request $request){
    if(!$request->hasFile('audio')){
        return response()->json(
            ['error'=>'no audio file uploaded',400]
        );
    }
    $filePath=$this->storeFile($request->file('audio'));
    $fullPath=Storage::disk('public')->path($filePath);
    $result=$this->transcribeAudio($fullPath);
    return response()->json($result->text);
}
public function storeFile($file){
    $filePath=$file->store('public/ai');
    return str_replace('public/', '',$filePath);
}
private function transcribeAudio($file){
   return OpenAI::audio()->transcribe([
    'model'=>'whisper-1',
    'file'=>fopen($file, 'r'),
    'response_format'=>'verbose_json',
   ]);
}
public function arabictransform(Request $request){
    $result=OpenAI::chat()->create([
    'model'=>'gpt-3.5-turbo',
    'messages'=>[
    [
    'role'=>'user',
    'content'=>'rewrite following in one sentence,the response
     language should be in official arabic:\n'.$request->text
    ],
],
    ]);
    return $result['choices'][0]['message']['content'];
}
}
