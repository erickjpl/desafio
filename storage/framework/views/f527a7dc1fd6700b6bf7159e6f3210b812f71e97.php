<?php $__env->startComponent('mail::message'); ?>
<?php echo e(__("Hola **:name :lastname**, bienvenido!", ['name' => $user->name, 'lastname' => $user->lastname])); ?><br />
<?php echo e(__("Su registro ha sido satisfactorio..!")); ?><br />

<?php echo e(__("Sus datos:")); ?><br />
...<?php echo e(__("**email:** :email", ['email' => $user->email])); ?><br />
...<?php echo e(__("**usuario:** :user", ['user' =>$user->name])); ?><br />

<?php echo e(__("Gracias por registrarse")); ?><br />
<?php echo e(__("app.name")); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/casa/Documentos/laravel/desafio/resources/views/emails/register_user.blade.php ENDPATH**/ ?>