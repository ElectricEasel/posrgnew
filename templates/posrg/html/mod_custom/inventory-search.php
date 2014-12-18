<?php defined('_JEXEC') or die;

    JLoader::register('PartsModelList', JPATH_SITE . '/components/com_parts/model/list.php');
    $model = new PartsModelList;
    $mfc_list = $model->getMfcSelectList();

?>

<form class="form-inline" name="inventory-search" id="inventory-search" action="/inventory/search-our-inventory" method="get">
    <div class="form-group col-sm-4">
        <legend>Search Our Inventory:</legend>
    </div>
    <div class="form-group col-sm-3">
        <label class="sr-only" for="manufacturer">Manufacturer</label>
        <?=$mfc_list?>
    </div>
    <div class="form-group col-sm-3">
        <label  class="sr-only" for="part_number">Part Number</label>
        <input type="text" placeholder="Keyword or Part ID"/>
    </div>
    <div class="form-group col-sm-2">
        <button type="submit" class="btn btn-primary">search</button>
    </div>
</form>