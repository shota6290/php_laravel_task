<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでNews Modelが扱えるようになる
use App\Profile;

use App\ProfileHistory;

use Carbon\Carbon;

class ProfilesController extends Controller
{
  public function add()
  {
      return view('admin.profiles.create');
  }

  public function create(Request $request)
  {

      // 以下を追記
      // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profiles = new Profile;
      $form = $request->all();



      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
     
        $profiles->fill($form);
        $profiles->save();

      return redirect('admin/profile/create');
  }
  
  
  public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profiles.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
  
  
  public function edit(Request $request)
  {
  $profile = Profile::find($request->id);
  if(empty($profile)){
    abort(404);
  }
  return view('admin.profiles.edit',['profile_form'=>$profile]);
  }
  
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profiles = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profiles_form = $request->all();
      unset($profiles_form['_token']);
      
      
        unset($profiles_form['image']);
        unset($profiles_form['remove']);
        unset($profiles_form['_token']);
        

      $profiles->fill($profiles_form)->save();
      
      $history = new ProfileHistory;
      $history->profile_id = $profiles->id;
      $history->edited_at = Carbon::now();
      $history->save();
      
      return redirect('admin/profile');
  }
  
      public function delete(Request $request)
    {
      $profiles = Profile::find($request->id);
      
      $profiles->delete();
      return redirect('admin/profile/');
    }
  
  
  
  
}
