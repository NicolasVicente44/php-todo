<div class="container">
    <h1>List Statuses</h1>

    <a href="<?= ROOT_PATH ?>/statuses/new" class="btn btn-primary my-3">New status...</a>

    <?php if (isset($statuses) && count($statuses) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($statuses as $status): ?>
                <tr>
                    <td><?= $status->name ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/statuses/edit/<?= $status->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/statuses/delete/<?= $status->id ?>" onclick="return confirm('Are you sure you want to delete this status?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>