<h1>New post</h1>

<form>
    
    <div class="panel panel-default">
        <div class="panel-heading">&raquo; Details</div>
        <div class="panel-body hidden">

            <fieldset>
                <legend>Post</legend>  
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="input-group-addon">Title</div>
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title_url" placeholder="http://example.com/post/lorem-ipsum-dolor-sit-amet" disabled>
                </div><br><br><br>
                <div class="col-sm-12">
                    <div class="input-group">
                        <div class="input-group-addon">Author</div>
                        <input type="text" class="form-control" name="author" value="<?php echo escape($user->data()->name); ?>" placeholder="Author"><br>
                    </div><br>
                    <div class="input-group">
                        <div class="input-group-addon">Date</div>
                        <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>""><br>
                    </div><br>
                    <div class="input-group">
                        <div class="input-group-addon">Category</div>
                        <input type="text" class="form-control" name="category" placeholder="Start typing to show auto-complete list...">
                    </div>
                </div>
            </fieldset>

            <br><br>
            <fieldset>
                <legend>Cover image</legend>
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="cover_image" placeholder="cover-image.jpg">
                    </div>
                    <div class="col-sm-6">
                        <div style="width:200px;height:80px;border:1px solid #999999; background:#eeeeee;text-align:center;padding-top:30px;">Preview</div>
                    </div>
                </div>
            </fieldset>

            
        </div>
    </div>
    
    
    <div class="panel panel-default">
        <div class="panel-heading">&raquo; Content</div>
        <div class="panel-body hidden">
            <div id="editor" class="col-lg-12">
                <textarea id="editor"></textarea>
            </div>
        </div>
    </div>
    
    
    <div class="panel panel-default">
        <div class="panel-heading">&raquo; Advanced</div>
        <div class="panel-body hidden">
            <fieldset>
                <legend>Meta tags</legend>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="meta_description" placeholder="Description"><br>
                    <input type="text" class="form-control" name="meta_robots" placeholder="Robots (i.e. INDEX, NOINDEX, FOLLOW, NOFOLLOW)"><br>
                </div>
            </fieldset>
            <br>

            <div class="col-sm-12">
                Post visibility<br>
                <button class="btn btn-success">Show</button>
            </div>

        </div>
    </div>
    
    <button class="btn btn-lg btn-success">Save</button> &nbsp; &nbsp; 
    <button class="btn btn-lg btn-primary">Publish</button> &nbsp; &nbsp; 
    <button class="btn btn-lg btn-warning">Schedule</button> &nbsp; &nbsp; 
    <button class="btn btn-info">Send copy</button> &nbsp; &nbsp; 
    <button class="btn btn-danger">Reset</button>
    
            

    
</form>



        
        
        
        
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
var instructions_simplemde = 'Cmd-"	"toggleBlockquote"\n\
Cmd-B	"toggleBold"\n\
Cmd-E	"cleanBlock"\n\
Cmd-H	"toggleHeadingSmaller"\n\
Cmd-I	"toggleItalic"\n\
Cmd-K	"drawLink"\n\
Cmd-L	"toggleUnorderedList"\n\
Cmd-P	"togglePreview"\n\
Cmd-Alt-C	"toggleCodeBlock"\n\
Cmd-Alt-I	"drawImage"\n\
Cmd-Alt-L	"toggleOrderedList"\n\
Shift-Cmd-H	"toggleHeadingBigger"\n\
F9	"toggleSideBySide"\n\
F11	"toggleFullScreen"';

var simplemde = new SimpleMDE({
    autofocus: true,
    autosave: {
        enabled: true,
        uniqueId: "ScorpionCMS-NewPost",
        delay: 1000,
    },
    indentWithTabs: false,
    /*placeholder: instructions_simplemde,*/
    tabSize: 4
});
//simplemde.value("Hello world");
</script>