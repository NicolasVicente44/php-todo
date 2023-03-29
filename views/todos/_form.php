<?php
    // Convert todo object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($todo)) $form_fields = (array) $todo;

    $statuses = $statuses ?? [];
?>

<form action="<?= ROOT_PATH ?>/todos/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="item">Item</label>
        <input class="form-control" type="text" name="item" value="<?= $form_fields["item"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="completed_datetime">Completed Date</label>
        <input class="form-control" type="datetime-local" name="completed_datetime" value="<?= $form_fields["completed_datetime"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="status">Status</label>
        <select name="status_id" class="form-select">
            <option selected>Select a status</option>
            <?php foreach ($statuses as $status): ?>
                <option value="<?= $status->id ?>" <?= isset($form_fields["status_id"]) && $form_fields["status_id"] == $status->id ? "selected" : "" ?>><?= $status->name ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>