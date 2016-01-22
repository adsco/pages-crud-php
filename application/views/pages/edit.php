Page edit: "<?php echo $page['title'] ?>"

<?php echo validation_errors() ?>

<?php echo form_open('page/edit/' . $page['id']) ?>
    <input type="hidden" name="id" value="<?php echo $page['id'] ?>" />
    <div class="form-group">
        <?php if($page['banner']): ?>
            <div>
                <img src="<?php echo $this->config->item('upload_path') . $page['banner'] ?>" class="banner" />
            </div>
        <?php endif; ?>
        <label>Banner</label>
        <input type="file" name="banner" class="form-control image-upload banner" />
    </div>
    
    <div class="form-group">
        <?php if($page['thumbnail']): ?>
            <div>
                <img src="<?php echo $this->config->item('upload_path') . $page['thumbnail'] ?>" class="thumbnail" />
            </div>
        <?php endif; ?>
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control image-upload thumbnail" />
    </div>
    
    <div class="form-group">
        <label>Url</label>
        <input type="text" name="slug" value="<?php echo $page['slug'] ?>" class="form-control" />
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $page['name'] ?>" class="form-control" />
    </div>
    
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo $page['title'] ?>" class="form-control" />
    </div>
    
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" id="summernote"><?php echo $page['content'] ?></textarea>
    </div>
    
    <input type="submit" value="Save" class="btn btn-success" />
    <a href="<?php echo site_url('pages') ?>" class="btn btn-default">Cancel</a>