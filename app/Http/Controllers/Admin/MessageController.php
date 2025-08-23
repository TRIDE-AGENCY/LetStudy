<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages()
    {
        $menuProducts = Product::with('subProducts')->get();

        $messages = Message::when(request()->q, function ($messages) {
            $messages = $messages->where('message', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $messages->appends(['q' => request()->q]);

        return inertia('Admin/Messages/Index', [
            'menuProducts' => $menuProducts,
            'messages' => $messages,
        ]);
    }

    public function messageUpdate(Request $request, Message $message)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $message->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.messages.index');
    }

    public function messageDestroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index');
    }
}
