<div id="mdeditor">
    <textarea style="display:none;" name="content"></textarea>
</div>

@push('styles')
<link rel="stylesheet" href="/vendor/mdeditor/css/editormd.css" />
@endpush

@push('scripts')
<script src="/vendor/mdeditor/editormd.min.js"></script>
<script type="text/javascript">
    var testEditor;

    $(function () {
        editormd.emoji = {
            path: "https://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/",
            ext: ".png"
        };
        editormd.twemoji = {
            path: "http://twemoji.maxcdn.com/72x72/",
            ext: ".png"
        };

        testEditor = editormd({
            id: "mdeditor",
            height: 640,
            path: "/vendor/mdeditor/lib/",
            toc: true,
            emoji: true,
            placeholder: "请输入内容……",
            imageUpload: true,
            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL: "{{route('admin.upload')}}",
            imageUploadFields: "<input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\"/>"
        });
    });

</script>
@endpush
