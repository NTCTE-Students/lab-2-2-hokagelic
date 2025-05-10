<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task manager</title>
</head>
<body>
    <h1>Task manager</h1>
    <p>Welcome to the task manager application!</p>
    <?php if(auth()->guard()->check()): ?>
        <p>Hello, <?php echo e(auth()->user()->name); ?>!</p>
        <ul>
            <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
        </ul>
    <?php else: ?>
        <p>To get started, please register or log in.</p>
        <ul>
            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
        </ul>
    <?php endif; ?>

    <h2>Tasks</h2>
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth() -> user() -> tasks() -> count() > 0): ?>
            <ul>
                <?php $__currentLoopData = auth()->user()->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <h3>
                            <b><?php echo e($task->title); ?></b>
                            -
                            <?php echo e($task->status); ?>

                            |
                            <a href="<?php echo e(route('tasks.index', $task -> id)); ?>">View</a>
                            <a href="<?php echo e(route('tasks.delete', $task -> id)); ?>">Delete</a>
                        </h3>
                        <p><?php echo e($task->description); ?></p>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <a href="<?php echo e(route('tasks.index')); ?>">Create a new task</a></p>
        <?php else: ?>
            <p>You have no tasks yet. <a href="<?php echo e(route('tasks.index')); ?>">Create a new task</a></p>
        <?php endif; ?>
    <?php else: ?>
        <p>You need to be logged in to see your tasks.</p>
    <?php endif; ?>
</body>
</html><?php /**PATH /nfs/home/hitrin.pavel/php-learning/laravel/todo-list/resources/views/index.blade.php ENDPATH**/ ?>