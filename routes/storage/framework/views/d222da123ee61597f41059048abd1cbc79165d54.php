
<?php $__env->startSection('content'); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home')->html();
} elseif ($_instance->childHasBeenRendered('LvlB9Rl')) {
    $componentId = $_instance->getRenderedChildComponentId('LvlB9Rl');
    $componentTag = $_instance->getRenderedChildComponentTagName('LvlB9Rl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LvlB9Rl');
} else {
    $response = \Livewire\Livewire::mount('home');
    $html = $response->html();
    $_instance->logRenderedChild('LvlB9Rl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon\laragon\www\LinhKien\resources\views/index.blade.php ENDPATH**/ ?>