<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // ユーザー識別子がなければランダムに生成してセッションに登録
        if($request->session()->missing('user_identifier')){ session(['user_identifier' => Str::random(20)]);}

        // ユーザー名を変数に登録(デフォルト値: Guest)
        if($request->session()->missing('user_name')){ session(['user_name' => 'Guest']);}

        // データベースの件数取得
        $length = Chat::all()->count();

        // 表示する件数を代入
        $display = 5;

        // 最新のチャットを画面に表示する分だけ取得して変数に代入
        $chats = Chat::offset($length-$display)->limit($display)->get();

        // チャットデータをにビューを渡して表示
        return view('chat/index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // ユーザー名をフォームから取得してセッションに登録
        session(['user_name' => $request->user_name]);

        // フォームに入力されたユーザー名をセッションに登録
        $chat = new Chat;
        $form = $request->all();
        $chat->fill($form)->save();
        
        // 最初の場面にリダイレクト
        return redirect('/chat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
