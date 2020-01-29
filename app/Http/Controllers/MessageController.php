<?php

namespace App\Http\Controllers;

use App\Message;
use Image;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::where('parent_id', 0)->paginate(25);
        return view('main', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'text'      => nl2br($request->text),
            'parent_id' => $request->parent_id,
            'user_id'   => \Auth::id(),
        ]);
        $this->saveImage($message->id);
        return redirect()->route('home');
    }

    public function validation(Request $request)
    {
        $validatedData = $request->validate([
            'text'  => 'max:1000',
            'image' => 'max:100',
        ]);

        if ($this->imageTooLarge()) {
            return response()->json(['message' => 'Large'], 422);
        }

        if ($this->imageTooSmall()) {
            return response()->json(['message' => 'Small'], 422);
        }
    }

    private function imageTooLarge()
    {
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $height = Image::make($image)->height();
            $width = Image::make($image)->width();
            if ($height > 500 || $width > 500) {
                return true;
            }
        }
    }

    private function imageTooSmall()
    {
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $height = Image::make($image)->height();
            $width = Image::make($image)->width();
            if ($height < 100 || $width < 100) {
                return true;
            }
        }
    }

    private function saveImage($id)
    {
        $item = Message::findOrFail($id);
        if (request()->hasFile('image')) {
            $path = request()->file('image')->store('public/images');
            $item->image = $path;
            $item->save();
        }
    }

}