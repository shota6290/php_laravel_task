<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでNews Modelが扱えるようになる
use App\Profile;

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

      return redirect('admin/profiles/create');
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
  return view('admin.profiles.edit'.['profile_form'=>$profile]);
  }
  
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      unset($profile_form['_token']);
      
      
        unset($profile_form['image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        

      $profile->fill($profile_form)->save();
      return redirect('admin/profiles');
  }
  
  
  
}