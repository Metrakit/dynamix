<textarea class="input-block-level" id="content" name="content" value="content" rows="18">{{{ Input::old('content', isset($page) ? $page->content : null) }}}</textarea>


<script>
tinyMCE.baseURL = "{{URL::to('/js/tinymce')}}";
tinymce.init({
    selector: "textarea#content",theme: "modern",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   filemanager_access_key:"{{Config::get('app.key')}}",
   external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
});

$('body').on('#myTab a','click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>