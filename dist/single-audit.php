<?php

namespace Toolkit;

use Toolkit\models\Media;
use Toolkit\models\Audit;

get_header()
?>

<?php Audit::current(function ($model) { ?>
    <h1 class="audit--title"><?= $model->title() ?></h1>
    <div class="audit--content"><?= $model->content() ?></div>

    <div>
        <? if ($model -> office()) : ?>
            <span class="audit--office"><?= $model->office()->title() ?></span>
        <? endif ?>
    </div> 

    <div>
        <? if ($model -> audit_language()) : ?>
            <span class="audit--language"><?= $model->audit_language() ?></span>
        <? endif ?>
    </div>

    <div>
        <? if ($model -> audit_date()) : ?>
            <span class="audit--date"><?= date_i18n('F Y', $model->audit_date()) ?></span>
        <? endif ?>
    </div>

    <div>
        <? if ($model -> has_documents()) : ?>
            <span class="audit--documents"><?= __('Dokumente', 'efk') ?></span>
            <? foreach( $model -> documents() as $document) { ?>

                <div class="audit--document">
                    <? $media = new Media($document['document']) ?>
                    <a href="<?= $media->link() ?>" target="_blank">
                        <span><?= __($document['typ'], 'efk') ?></span>
                        <span><?= $media -> link() ?></span>
                    </a>
                    
                </div>
            <? } ?>
        <? endif ?>
    </div>

    <div>
        <?= __($model -> foobar(), 'efk') ?>
    </div>




<?php }); ?>

<?php get_footer() ?>