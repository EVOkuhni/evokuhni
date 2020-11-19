<div class="product-params-block">
    <div class="title">Подходящие параметры</div>
    <div class="text bas_our_margin">
        <table class="table table-striped">
            <?foreach($arResult['DISPLAY_PROPERTIES'] as $arItem):?>
            <tr>
                <td class="product-param-title"><?=$arItem['NAME']?>:</td>
                <td>
                    <?php if(is_array($arItem['DISPLAY_VALUE'])): ?>
                        <?php foreach ($arItem['DISPLAY_VALUE'] as $value): ?>
                            <span class="badge badge-pill badge-light"><?= $value ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="badge badge-pill badge-light"><?= $arItem['DISPLAY_VALUE'] ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>