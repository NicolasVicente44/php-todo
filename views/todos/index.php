<div class="container">
    <h1>List Todos</h1>

    <a href="<?= ROOT_PATH ?>/todos/new" class="btn btn-primary my-3">New todo...</a>

    <?php if (isset($todos) && count($todos) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td><?= $todo->item ?></td>
                    <td><?= $todo->status ?></td>
                    <td><?= $todo->completed_datetime ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/todos/edit/<?= $todo->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/todos/delete/<?= $todo->id ?>" onclick="return confirm('Are you sure you want to delete this todo?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>