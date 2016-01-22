<div class="row">
    <a href="<?php echo site_url('page/add') ?>" class="btn btn-success pull-right">Add new</a>
</div>

<hr/>

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Thumbnail</th>
        <th>Page Title</th>
        <th>Last Modified</th>
        <th>Action</th>
    </tr>
    <?php foreach($pages as $pageItem): ?>
    <tr>
        <td><?php echo $pageItem['id'] ?></td>
        <td>
            <?php if($pageItem['thumbnail']): ?>
                <img src="<?php echo $this->config->item('upload_path') . $pageItem['thumbnail'] ?>" class="thumbnail" />
            <?php else: ?>
                Not uploaded
            <?php endif; ?>
        </td>
        <td><?php echo $pageItem['title'] ?></td>
        <td><?php echo $pageItem['last_modified'] ?></td>
        <td>
            <a href="<?php echo site_url('page/edit/' . $pageItem['id']) ?>" class="btn btn-primary">Edit</a>
            <a href="<?php echo site_url('page/remove/' . $pageItem['id']) ?>" class="btn btn-danger confirm-delete">Delete</a>
        </td>
    </tr>
    <?php endforeach;  ?>
</table>