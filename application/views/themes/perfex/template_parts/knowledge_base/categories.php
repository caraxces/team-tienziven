<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<ul role="list" class="tw-divide-y tw-divide-neutral-200">
    <?php foreach ($articles as $category) { ?>
    <li class="tw-py-2 last:tw-pb-0 first:tw-pt-0">
        <div class="tw-flex tw-items-center">
            <h3 class="tw-text-base tw-font-semibold tw-my-0 tw-text-neutral-800">
                <a href="<?= site_url('knowledge-base/category/' . e($category['group_slug'])); ?>"
                    class="tw-text-neutral-600 hover:tw-text-neutral-800 active:tw-text-neutral-800">
                    <?= e($category['name']); ?>
                </a>
                <span class="badge tw-bg-neutral-50 tw-ml-1">
                    <?= e(count($category['articles'])); ?>
                </span>
            </h3>
        </div>
        <p class="tw-text-neutral-500 tw-mb-0 tw-mt-1">
            <?= e($category['description']); ?>
        </p>
    </li>
    <?php } ?>
</ul>