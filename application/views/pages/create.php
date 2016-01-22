<?php echo validation_errors() ?>

<?php echo form_open_multipart('page/add') ?>
    <div class="form-group">
        <div>
            <img src="" id="image-preview-banner" class="hidden" />
        </div>
        <label>Banner</label>
        <input type="file" name="banner" class="form-control image-upload banner" data-preview="image-preview-banner" />
    </div>
    
    <div class="form-group">
        <div>
            <img src="" id="image-preview-thumbnail" class="hidden" />
        </div>
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control image-upload thumbnail" data-preview="image-preview-thumbnail" />
    </div>
    
    <div class="form-group">
        <label>Url</label>
        <input type="text" name="slug" value="<?php echo set_value('slug') ?>" class="form-control" />
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo set_value('name') ?>" class="form-control" />
    </div>
    
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo set_value('title') ?>" class="form-control" />
    </div>
    
    <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" id="summernote"><?php echo set_value('content') ?></textarea>
    </div>
    
    <input type="submit" value="Save" class="btn btn-success" />
    <a href="<?php echo site_url('pages') ?>" class="btn btn-default">Cancel</a>