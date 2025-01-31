<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image');//imageのid取得
            if(!is_null($id)){ //null判定
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId;//キャスト　文字列->数値に型変換
                if($imageId !== Auth::id()){ //同じでなかったら
                    abort(404);// 404画面表示
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        $images = Image::where('owner_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(20);

        return view('owner.images.index',
        compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        $imageFiles = $request->file('files');//複数の画像を取得する
        if(!is_null($imageFiles)){//null判定をして$imageFilesが空でなければ
            foreach($imageFiles as $imageFile){
                $fileNameToStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore
                ]);
            }
        }

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像登録を実施しました。', 'status' => 'info']);//フラッシュメッセージ
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('owner.images.edit', compact('image'));//compactで変数に渡す
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
        $request->validate([
            'title' => 'string|max:50',
        ]);

        $image = Image::findOrFail($id);//findOrFail($id)は$idが見つからなかった場合エラーを返す。例外処理(https://qiita.com/moutoonm342/items/995f11de4275b43d7f4c)
        $image->title = $request->title;

        $image->save();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像情報を更新しました。',
        'status' => 'info']);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        /*202501エラー
            Too few arguments to function Illuminate\Database\Eloquent\Builder::findOrFail(), 0 passed in /src/vendor/laravel/framework/src/Illuminate/Support/Traits/ForwardsCalls.php on line 23 and at least 1 expected

            エラー原因：findOrFail()に引数外というエラー
            解決方法：引数に値を入力
            参考サイト:https://qiita.com/Aiga/items/9e596f198a7f09944e27
        */

        $imageINProduct = Product::where('image1', $image->id)
        ->orWhere('image2', $image->id)
        ->orWhere('image3', $image->id)
        ->orWhere('image4', $image->id)
        ->get();

        if($imageINProduct){
            $imageINProduct->each(function($product) use($image){
                if($product->image1 === $image->id){
                    $product->image1 = null;
                    $product->save();
                }
                if($product->image2 === $image->id){
                    $product->image2 = null;
                    $product->save();
                }
                if($product->image3 === $image->id){
                    $product->image3 = null;
                    $product->save();
                }
                if($product->image4 === $image->id){
                    $product->image4 = null;
                    $product->save();
                }
            });
        }

        $filePath = 'public/peoducts/' . $image->filename;

        if(Storage::exists($filePath)){
            //exits(引数)は引数のファイルが存在しているかの確認(Stroageまとめ[https://qiita.com/suzu12/items/9f43f9bddc735dbbfa07])
            Storage::delete($filePath);
            //delete(引数)は引数を削除する
        }

        Image::findOrFail($id)->delete();//ソフトデリート(論理削除)：復元可能な削除

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像を削除しました。', 'status' => 'alert']);
    }
}
// php artisan make:controller Owner/ImageController --resource で作成
