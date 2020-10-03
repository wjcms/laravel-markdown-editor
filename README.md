# laravel-markdown-editor
laravel-markdown-editor--markdown编辑器
# 说明
> 此扩展包兼容laravel5.8以上版本

# 准备工作

```
//laravel
'providers' => [
    //添加如下一行
    wjcms\laravelmd\LaravelmdServiceProvider::class,
]
```

## 拷贝相关文件到项目文件夹中
```
php artisan vendor:publish --provider="wjcms\laravelmd\LaravelmdServiceProvider"
```

## 使用
1. 在blade模版引入
```
@include('layouts.md.md')
```
2.父模版中需要添加上

```
@stack('styles')

@stack('scripts')
```

3.修改md.blade.php文件的
imageUploadURL修改为接口路径

4.创建service服务uploadservice.php,实现如下方法。
```
public function upload(UploadedFile $file)
    {
        $path = '/uploads/'.$file->store(date('y/m'), 'uploads');
        return $this->save($file, $path);
    }

//注意这里还需要创建Attachment模型和数据库（包含path,extension,name三个字段）
    protected function save(UploadedFile $file, $path)
    {
        return Attachment::create([
            'path'=>$path,
            'extension'=>$file->extension(),
            'name'=>$file->getClientOriginalName()
        ]);
    }
```

5.admin控制器创建方法
```
/**
     * 图片上传方法
     */
    public function uploadPic(Request $request, UploadService $uploadService)
    {
        $res = $uploadService->upload($request->file('editormd-image-file'));
        return response()->json([
            'success'=>1,
            'message'=>'图片上传成功',
            'url'=> $res->path
        ]);
    }
```
6.routes/web.php文件添加路由
```
use App\Http\Controllers\Admin;
//注意这里是laravel8的写法，之前版本自行修改
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('upload', [Admin\AdminController::class,'uploadPic'])->name('upload');
}
```


![](https://wjcms.oss-cn-beijing.aliyuncs.com/blog/20200815094204.jpg?x-c-oss-press=xpsdaklgvnakjvcbnajkhbf)